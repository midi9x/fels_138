<?php

App::uses('Helper', 'View');

class ShowContentHelper extends Helper
{
    const FOLLOW = 1;
    const UN_FOLLOW = -1;
    public function showFollowButton($isFollow = 1, $options = [])
    {
        if (!in_array($isFollow, [self::FOLLOW, self::UN_FOLLOW])) {

            return '';
        }
        $options['label'] = $isFollow == self::FOLLOW ? __('Follow') : __('Unfollow');
        $options['class'] = $isFollow == self::FOLLOW ? 'follow-button ' . $options['followClass'] : 'unfollow-button ' . $options['unfollowClass'];

        return '<button class="' . $options['class'] . '">' . $options['label'] . '</button>';
    }

    public function showFollow($followList = [])
    {
        if (!is_array($followList) || count($followList) == 0) {
            return '<div class="alert alert-warning"><strong>' . __('No data found!') . '</strong></div>';
        }
        $html = '';
        foreach ($followList as $followId => $followName) {
            $html[] = '<a target="_blank" href="/users/view/id/' . $followId . '">' . $followName . '</a>';
        }
        return implode(', ', $html);
    }
}