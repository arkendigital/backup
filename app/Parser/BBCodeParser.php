<?php
namespace App\Parser;

use Golonka\BBCode\BBCodeParser as ParentBBCodeParser;

class BBCodeParser extends ParentBBCodeParser
{
    public $extraParsers = [
        'paragraph' => [
            'pattern' => '/\[p\](.*?)\[\/p\]/s',
            'replace' => '<p>$1</p>',
            'content' => '$1'
        ],
        'break' => [
            'pattern' => '/\[br\]/s',
            'replace' => '<br>',
        ],
        'strike' => [
            'pattern' => '/\[del\](.*?)\[\/del\]/s',
            'replace' => '<del>$1</del>',
            'content' => '$1'
        ],
        'file' => [
            'pattern' => '/\[file\=(.*?)\](.*?)\[\/file\]/s',
            'replace' => '$2',
            'content' => '$2'
        ],
        'font' => [
            'pattern' => '/\[font\=(.*?)\](.*?)\[\/font\]/s',
            'replace' => '<font face="$1">$2</font>',
            'content' => '$2'
        ],
    ];

    public function __construct()
    {
        $this->parsers = array_merge($this->parsers, $this->extraParsers);

        parent::__construct();
    }
}
