<?php

namespace lawsaw\models\common;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

use omgdef\multilingual\MultilingualQuery;
use omgdef\multilingual\MultilingualBehavior;
use lawsaw\models\common\Lang;
use yii\imagine\Image;

/**
 * Модель постов.
 *
 * @property string $id
 * @property string $title заголовок
 * @property string $anons анонс
 * @property string $image картинка
 * @property string $content контент
 * @property string $category_id категория
 * @property string $author_id автор
 * @property string $publish_status статус публикации
 * @property string $publish_date дата публикации
 *
 * @property User $author
 * @property Category $category
 * @property Comment[] $comments
 */
class Post extends ActiveRecord
{

    public $imageFile;

    /**
     * Статус поста: опубликованн.
     */
    const STATUS_PUBLISH = 'publish';
    /**
     * Статус поста: черновие.
     */
    const STATUS_DRAFT = 'draft';

    /**
     * Список тэгов, закреплённых за постом.
     * @var array
     */
    protected $tags = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    public static function tableNameTranslate()
    {
        return '{{%post_translate}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['category_id', 'author_id'], 'integer'],
            [['anons', 'content', 'description', 'publish_status'], 'string'],
            [['publish_date', 'tags'], 'safe'],
            [['title', 'image'], 'string', 'max' => 255],
            [['imageFile'] , 'imageValidate']
        ];
    }

    public function behaviors()
    {
        return[
            /**
             * Multilanguage behavior
             * @see https://github.com/OmgDef/yii2-multilingual-behavior
             **/
            'ml' =>
                [
                    'class' => MultilingualBehavior::className(),
                    'languages' => Lang::getLangList(),
                    'defaultLanguage' => Lang::getDefaultLang()->url,
                    'tableName' => Post::tableNameTranslate(),
                    'langForeignKey' => 'post_id',
                    'attributes' =>
                        [
                            'title',
                            'description',
                            'anons',
                            'content'
                        ]
                ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'title' => Yii::t('backend', 'Title'),
            'image' => 'Image',
            'description' => 'Description',
            'anons' => Yii::t('backend', 'Announce'),
            'content' => Yii::t('backend', 'Content'),
            'category' => Yii::t('backend', 'Category'),
            'tags' => Yii::t('backend', 'Tags'),
            'category_id' => Yii::t('backend', 'Category ID'),
            'author' => Yii::t('backend', 'Author'),
            'author_id' => Yii::t('backend', 'Author ID'),
            'publish_status' => Yii::t('backend', 'Publish status'),
            'publish_date' => Yii::t('backend', 'Publish date'),
            'imageFile' => 'Image File',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    /**
     * Возвращает опубликованные комментарии
     * @return ActiveDataProvider
     */
    public function getPublishedComments()
    {
        return new ActiveDataProvider([
            'query' => $this->getComments()
                ->where(['publish_status' => Comment::STATUS_PUBLISH])
        ]);
    }

    /**
     * Устанавлиает тэги поста.
     * @param $tagsId
     */
    public function setTags($tagsId)
    {
        $this->tags = (array) $tagsId;
    }

    /**
     * Возвращает массив идентификаторов тэгов.
     */
    public function getTags()
    {
        return ArrayHelper::getColumn(
            $this->getTagPost()->all(), 'tag_id'
        );
    }

    /**
     * Возвращает тэги поста.
     * @return ActiveQuery
     */
    public function getTagPost()
    {
        return $this->hasMany(
            TagPost::className(), ['post_id' => 'id']
        );
    }

    /**
     * Возвращает опубликованные посты
     * @return ActiveDataProvider
     */
    public function getPublishedPosts()
    {
        return new ActiveDataProvider([
            'query' => Post::find()
                ->where(['publish_status' => self::STATUS_PUBLISH])
                ->orderBy(['publish_date' => SORT_DESC])
        ]);
    }

    /**
     * Возвращает модель поста.
     * @param int $id
     * @throws NotFoundHttpException в случае, когда пост не найден или не опубликован
     * @return Post
     */
    public function getPost($id)
    {
        if (
            ($model = Post::findOne($id)) !== null &&
            $model->isPublished()
        ) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested post does not exist.');
        }
    }

    /**
     * @inheritdoc
     */

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);

        if($this->isNewRecord)
        {
            $this->publish_date = date('Y-m-d H:i:s');
        }
        if(empty($this->post_time))
        {
            $this->publish_date = date('Y-m-d H:i:s');
        }

        if(!empty($this->imageFile))
        {
            $filename = '/images/news/'.md5($this->imageFile->name) . "." . $this->imageFile->extension;

            $this->imageFile->saveAs(Yii::getAlias('@storage').$filename , true);

            $this->image = $filename;
        }


        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        TagPost::deleteAll(['post_id' => $this->id]);

        if (is_array($this->tags) && !empty($this->tags)) {
            $values = [];
            foreach ($this->tags as $id) {
                $values[] = [$this->id, $id];
            }
            self::getDb()->createCommand()
                ->batchInsert(TagPost::tableName(), ['post_id', 'tag_id'], $values)->execute();
        }

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * Опубликован ли пост.
     * @return bool
     */
    protected function isPublished()
    {
        return $this->publish_status === self::STATUS_PUBLISH;
    }


    /**
     * overloading standart find() func for multilanguage
     * @link https://github.com/OmgDef/yii2-multilingual-behavior
     * */
    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    public function imageValidate($attribute)
    {
        if (!empty($this->imageFile)) {
            $image = $this->imageFile;
            /**@var $image \yii\web\UploadedFile */

            list($width, $height) = getimagesize($image->tempName);

            if ($height !== 600 || $width !== 1000) {
                //$this->addError($attribute, 'Image must be 1000x600 only');
            }
        }
    }
}
