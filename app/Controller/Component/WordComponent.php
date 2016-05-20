<?php

class WordComponent extends Component
{

    public function countTotalWordLearned($user_id)
    {
        $lessonModel = ClassRegistry::init('Lesson');
        $options = [
            'joins' => [
                [
                    'table' => 'lessons_words',
                    'alias' => 'lw',
                    'type' => 'inner',
                    'conditions' => ['`lw`.`lesson_id` = `Lesson`.`id`']
                ]
            ],
            'condition' => [
                '`lw.user_id`' => 'is not nul',
                '`Lesson`.`user_id`' => $user_id
            ],
            'fields' => ['COUNT(`lw`.`word_answer_id`) as `total_word_learned`']
        ];
        $wordLearned = $lessonModel->find('first', $options);

        return $wordLearned[0]['total_word_learned'];
    }

    public function countWordLearned($user_id)
    {
        $lessonModel = ClassRegistry::init('Lesson');
        $options = [
            'joins' => [
                [
                    'table' => 'lessons_words',
                    'alias' => 'lw',
                    'type' => 'inner',
                    'conditions' => ['`lw`.`lesson_id` = `Lesson`.`id`']
                ]
            ],
            'condition' => [
                '`lw`.`user_id`' => 'is not nul',
                '`Lesson`.`user_id`' => $user_id
            ],
            'group' => '`Lesson`.`category_id`',
            'fields' => ['COUNT(`lw`.`word_answer_id`) as `total_word_learned`', '`Lesson`.`category_id` as `category_id`']
        ];
        $wordLearned = $lessonModel->find('all', $options);
        $data = [];
        foreach ($wordLearned as $category) {
            $data[$category['Lesson']['category_id']] = (int)$category[0]['total_word_learned'];
        }

        return $data;
    }

    public function countTotalWordInCategory()
    {
        $categoryModel = ClassRegistry::init('Category');
        $options = [
            'joins' => [
                [
                    'table' => '`words`',
                    'alias' => 'w',
                    'type' => 'inner',
                    'conditions' => ['`Category`.`id` = `w`.`category_id`']
                ],
            ],
            'fields' => ['COUNT(`w`.`id`) as `total_word`', '`Category`.`id`'],
            'group' => '`Category`.`id`',
        ];
        $rawData = $categoryModel->find('all', $options);
        $totalWordInCategory = [];
        foreach ($rawData as $data) {
            $totalWordInCategory[$data['Category']['id']] = (int)$data[0]['total_word'];
        }

        return $totalWordInCategory;
    }


    public function fillIssetValue($data, $categories)
    {
        if (!$categories || !is_array($categories)) {

            return $data;
        }
        $ids = $this->getCategoryIds($categories);
        foreach ($ids as $id) {
            if (!isset($data[$id])) {
                $data[$id] = 0;
            }
        }

        return $data;
    }

    private function getCategoryIds($categories)
    {
        $ids = [];
        foreach ($categories as $category) {
            $ids[] = $category['Category']['id'];
        }

        return $ids;
    }


}