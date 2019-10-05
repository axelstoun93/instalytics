<?php

namespace InstagramAPI\Exception;

use Throwable;

/**
 * Used for endpoint calls that fail with HTTP code "404 Not Found", but only
 * if no other more serious exception was found in the server response.
 */

class NotFoundException extends EndpointException{

}
