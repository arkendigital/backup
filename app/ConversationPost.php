<?php

namespace App;

use App\Parser\BBCodeParser as BBCode;

class ConversationPost extends \Cmgmyr\Messenger\Models\Message
{
    /**
     * Get the Body Attribute
     *
     * @return string
     */
    public function getBodyAttribute($body)
    {
        $parser = new BBCode;
        $body = $parser->parseCaseInsensitive($body);
        $body = clean($body, 'youtube');

        return $body;
    }

    /**
     * Set the Body Attribute
     *
     * @return void
     */
    public function setBodyAttribute($body)
    {
        $this->attributes['body'] = clean($body);
    }
}
