<?php

declare(strict_types=1);

return [
    'board_table' => 'board',
    'forum_table' => 'forum',
    'thread_table' => 'thread',
    'thread_reply_table' => 'thread_reply',
    'serve-forum-from-root' => false,
    'base-uri-segment'      => 'community' // if serve-forum-from-root is false, then this sets the segment to route the forum
];