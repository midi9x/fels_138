<?php

class FilterWordComponent extends Component 
{
    public $components = ['Word'];

    CONST LEARNED = 1;
    CONST NOT_LEARNED = 2;
    CONST FILTER_ALL = 3;

    public function filter($userId, $category_id = 0, $filter = self::FILTER_ALL)
    {
        $conditions = []; 
        $wordLearnedId = $this->Word->wordLearned($userId);
        if ($category_id > 0) {
            $conditions += ['category_id' => $category_id];
        }

        switch ($filter) {
            case self::LEARNED:
                $conditions += ['Word.id' => $wordLearnedId];
                break;
            case self::NOT_LEARNED:
                $conditions += ['NOT' => [
                    'Word.id' => $wordLearnedId
                    ]
                ];
                break;
            default:
                break;
        }

        return [
            'conditions' => $conditions,
        ];
    }

}