<?php
class AppController extends Controller {
    var $helpers = array(
        'Html',
        'Javascript',
        'Form',
        'Asset' => array(
            'md5FileName'   => true,
            'checkTs'       => true,
            'cssCompression'=> 'default',
            'debug'         => true
        )
    );
}
