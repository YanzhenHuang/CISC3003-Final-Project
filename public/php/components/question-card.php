<?php
/**
 * @param $p_id Post ID
 * @param $u_name User Name
 * @param $p_is_closed  Whether the question is closed or not.
 * @param $p_create_time Time of creation.
 * @param $p_content    Content of this question.
 */

function renderQuestionCard($p_id, $u_name, $p_is_closed, $p_create_time, $p_content)
{

    // Format display time
    $p_create_time = getDisplayTimeString($p_create_time);
    $close_style_tag = '';
    $p_is_closed == 1 ? $close_style_tag = 'question-closed' : '';

    echo '<a href="./post-details.php?post_id=' . $p_id . '">';
    echo '<div class="question-card content-block ' . $close_style_tag . '" id="p_id-' . $p_id . '">';

    // Question card header
    echo '<div class="card-title">';
    echo '<p class="user-name primary">' . $u_name . '</p> ';

    echo '<div class="question-status-container">';
    if ($p_is_closed == 1)
        echo '<p class="closed-tag">Closed</p>';
    echo '<p class="create-time secondary">' . $p_create_time . '</p>';
    echo '</div>';

    echo '</div>';

    echo '<p class="content">' . $p_content . '</p>';

    echo '</div>';
    echo '</a>';
}