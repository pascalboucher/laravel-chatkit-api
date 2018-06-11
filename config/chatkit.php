<?php

return [

    /*
     |--------------------------------------------------------------------------
     | Chatkit instance locator
     |--------------------------------------------------------------------------
     |
     | You must enter a instance locator.
     | Get this from your Chatkit app dashboard
     */

    'instance_locator' => getenv('CHATKIT_INSTANCE_LOCATOR'),

    /*
     |--------------------------------------------------------------------------
     | Chatkit secret key
     |--------------------------------------------------------------------------
     |
     | You must enter a valide secret key.
     | Get this from your Chatkit app dashboard
     */

    'key' => getenv('CHATKIT_SECRET_KEY'),

];