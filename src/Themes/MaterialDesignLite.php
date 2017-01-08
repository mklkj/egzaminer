<?php

namespace Egzaminer\Themes;

use Tamtamchik\SimpleFlash\BaseTemplate;
use Tamtamchik\SimpleFlash\TemplateInterface;

class MaterialDesignLite extends BaseTemplate implements TemplateInterface
{
    protected $prefix  = '
        var notification = document.querySelector(".mdl-js-snackbar");
        notification.MaterialSnackbar.showSnackbar({ message: "';

    protected $postfix = '"});';

    protected $wrapper = '
        <div class="mdl-js-snackbar mdl-snackbar">
          <div class="mdl-snackbar__text"></div>
          <button class="mdl-snackbar__action" type="button"></button>
        </div>
        <script>window.addEventListener("load", function(){%s});</script>';

    /**
     * @param $messages message text
     * @param $type     message type: success, info, warning, error
     *
     * @return string
     */
    public function wrapMessages($messages, $type)
    {
        return sprintf($this->getWrapper(), $messages);
    }
}
