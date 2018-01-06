<?php

namespace Egzaminer\Themes;

use Tamtamchik\SimpleFlash\BaseTemplate;

class MaterialDesignLite extends BaseTemplate
{
    protected $prefix = '
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
     * @param string $messages message text
     * @param string $type     message type: success, info, warning, error
     *
     * @return string
     */
    public function wrapMessages($messages, $type): string
    {
        return sprintf($this->getWrapper(), $messages);
    }
}
