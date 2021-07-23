<?php

use yii\db\Migration;

/**
 * Class m210723_112908_insert_testData
 */
class m210723_112908_insert_testData extends Migration
{
    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function safeUp()
    {
        $this->insert('{{%posts_image}}', [
            'id' => 1,
            'name' => '2021_05_04_-SiO_S_Vse_budet-06_id=1627017994',
            'extension' => 'png',
        ]);

        $this->insert('{{%posts_category}}', [
            'name' => 'Css',
        ]);
        $this->insert('{{%posts_category}}', [
            'name' => 'Wordpress',
        ]);

        for ($i = 0; $i < 3; $i++) {

            $this->insert('{{%posts_post}}', [
                'user_id' => 1,
                'title' => 'CSS Gallery Examples 2020',
                'description' => '47+ Best CSS Gallery Examples from hundreds of the CSS Gallery reviews in the market (Codepen.io)',
                'content' => '
                47+ Best CSS Gallery Examples from hundreds of the CSS Gallery reviews in the market (Codepen.io) as 
                derived from Avada Commerce Ranking which is using Avada Commerce scores, rating reviews, search 
                results, social metrics. The bellow reviews were picked manually by Avada Commerce experts, if your 
                CSS Gallery does not include in the list, feel free to contact us. The best CSS Gallery css collection 
                is ranked and result in August 2020. You can find free CSS Gallery examples or alternatives to 
                CSS Gallery also.',
                'image_preview_id' => '1',
                'category_id' => '1',
                'created_at' => '2021-06-0' . ($i + 1),
                'updated_at' => '2021-06-0' . ($i + 1),
                'city_id' => random_int(1,2),
            ]);

            $this->insert('{{%posts_post}}', [
                'user_id' => 1,
                'title' => 'Создание галереи изображений на CSS сетке (с эффектом размытия и медиа запросами)',
                'description' => 'В этом уроке мы возьмём пачку ссылок на обычные миниатюры изображений и превратим их в отзывчивую галерею на CSS сетке, с эффектом размытия при наведении. А ещё мы применим крутой CSS трюк, чтобы это всё работало на тач-скринах.
                Вот что мы будем создавать:',
                'content' => '
                В этом уроке мы возьмём пачку ссылок на обычные миниатюры изображений и превратим их в отзывчивую галерею на CSS сетке, с эффектом размытия при наведении. А ещё мы применим крутой CSS трюк, чтобы это всё работало на тач-скринах.
                Вот что мы будем создавать:
                Немного фона
                Недавно, Рэйчел МакКоллин написала урок, объясняющий то, как в тему WordPress добавить галерею на основе ссылок на изображения.

                WORDPRESS
                Create a WordPress Image Gallery: Code the Plugin
                Rachel McCollin
                Эти ссылки действуют в качестве навигации для дочерних страниц, не зависимо от того на какой странице пользователь (или какую страницу вы выберите), а итоговый плагин выводит что-то типа этого:',
                'image_preview_id' => '1',
                'category_id' => '1',
                'created_at' => '2021-06-0' . ($i + 1),
                'updated_at' => '2021-06-0' . ($i + 1),
                'city_id' => random_int(1,2),
            ]);

            $this->insert('{{%posts_post}}', [
                'user_id' => 1,
                'title' => '10 лучших WordPress Twitter виджетов',
                'description' => 'С тех пор, как Twitter несколько лет назад изменил свой API, я думаю, что сторонние разработчики 
                    не решаются разрабатывать приложения и плагины, которые интегрируются с Twitter.',
                'content' => '
                    С тех пор, как Twitter несколько лет назад изменил свой API, я думаю, что сторонние разработчики 
                    не решаются разрабатывать приложения и плагины, которые интегрируются с Twitter. Когда вы 
                    принимаете решение о сомнительном будущем и более поздних изменениях (удаляя счетчики Twitter), 
                    легко понять, почему количество приложений и плагинов Twitter является разреженным.
                    Но Twitter все еще очень активен, и есть еще несколько разработчиков, которые хотят разрабатывать 
                    решения, которые смогут интегрироваться как можно лучше. Даже отмена подсчетов в Twitter была 
                    недостаточной для того, чтобы разработчики не смогли найти обходные пути.',
                'image_preview_id' => '1',
                'category_id' => '2',
                'created_at' => '2021-06-0' . ($i + 1),
                'updated_at' => '2021-06-0' . ($i + 1),
                'city_id' => random_int(1,2),
            ]);
        }

        $this->insert('{{%posts_favourite}}', [
            'user_id' => 1,
            'post_id' => 1,
        ]);
        $this->insert('{{%posts_favourite}}', [
            'user_id' => 1,
            'post_id' => 2,
        ]);
        $this->insert('{{%posts_favourite}}', [
            'user_id' => 1,
            'post_id' => 3,
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210723_112908_insert_testData cannot be reverted.\n";

        return false;
    }
}
