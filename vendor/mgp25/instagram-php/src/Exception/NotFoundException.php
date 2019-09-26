<?php

namespace InstagramAPI\Exception;
use App\CalendarAndroidTask;
use App\Repositories\CalendarAndroidTaskRepository;
use Throwable;

/**
 * Used for endpoint calls that fail with HTTP code "404 Not Found", but only
 * if no other more serious exception was found in the server response.
 */
class NotFoundException extends EndpointException
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        //Удаляем не рабочий аккаунт из списка
        $calendarAndroidTaskRepository = new CalendarAndroidTaskRepository(new CalendarAndroidTask());
        $res = $calendarAndroidTaskRepository->deleteFirstAccount();
        echo $message;
    }
}
