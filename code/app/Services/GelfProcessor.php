<?php

namespace App\Services;

/**
 * Fix messages to graylog of GelfProcessor
 *
 * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
 */
class GelfProcessor
{
    /**
     * Transform a "ID" string record into a "id_smsto" value.
     * Transform a "MESSAGE" string record into a "message_smsto" value.
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @param array $record
     * @return array
     */
    public function __invoke(array $record): array
    {
        foreach ($record['context'] as $key => $value) {
            if (
                strtoupper($key) == 'ID'
                | strtoupper($key) == '_ID'
                | strtoupper($key) == 'MESSAGE'
                | strtoupper($key) == 'PARTS'
                | strtoupper($key) == 'PRICE'
                | strtoupper($key) == 'TIME'
                | strtoupper($key) == 'SCHEDULED_FOR'
            )
            {
                $record['context'][$key . '_smsto'] = $value;
                unset($record['context'][$key]);
            }
        }

        $request = app(\Illuminate\Http\Request::class);
        $user = $request->user;
        if ($user)
        {
            $record['context']['email'] = $record['context']['email'] ?? $user->email;
            $record['context']['user_id'] = $record['context']['user_id'] ?? $user->id;
        }

        return $record;
    }

}
