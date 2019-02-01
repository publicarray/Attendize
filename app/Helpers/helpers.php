<?php

if (!function_exists('money')) {
    /**
     * Format a given amount to the given currency
     *
     * @param $amount
     * @param \App\Models\Currency $currency
     * @return string
     */
    function money($amount, \App\Models\Currency $currency)
    {
        return $currency->symbol_left . number_format($amount, $currency->decimal_place, $currency->decimal_point,
            $currency->thousand_point) . $currency->symbol_right;
    }

    /**
     * Get extras price (questions)
     * @param  object $ticket_order the ordered tickets
     * @return int               total extras price
     */
    function getExtrasPrice($ticket_order, $ticket_questions)
    {
        // todo find a better spot for this function
        $extras_price = 0;
        foreach ($ticket_order['tickets'] as $attendee_details) {
            // Log::info(['$attendee_details', $attendee_details]);
            for ($i = 0; $i < $attendee_details['qty']; $i++) {
                foreach ($attendee_details['ticket']->questions as $question) {
                    $ticket_answer = isset($ticket_questions[$attendee_details['ticket']->id][$i][$question->id]) ? $ticket_questions[$attendee_details['ticket']->id][$i][$question->id] : null;

                    if (is_null($ticket_answer)) {
                        continue;
                    }

                    switch ($question->question_type_id) {
                    case 3: // Dropdown (single selection)
                        $options = $question->options->toArray();
                        if (sizeof($options) > 0) {
                            $extras_price += $options[$ticket_answer]['price'];
                        }
                        break;
                    case 4: // Dropdown (multiple selection)
                    case 5: // Checkbox
                        foreach ($ticket_answer as $anwser) {
                            $extras_price += $question->options->where('name', $anwser)->first()->price;
                        }
                        break;
                    case 6: // Radio input
                        $extras_price += $question->options->where('name', $ticket_answer)->first()->price;
                        Debugbar::info($question->options->where('name', $ticket_answer));
                        break;
                    default:
                        break;
                    }
                }
            }
        }
        Debugbar::info('$extras_price', $extras_price);
        return $extras_price;
    }
}


