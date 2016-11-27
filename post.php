<?php
/**
 * Пример PHP кода для работы с Google reCaptcha.
 * Больше примеров смотрите на сайте http://backender.ru/
 * @author Dmitry R
 */

/**
 * Ваш приватный ключ от Google reCaptcha.
 */
const GOOGLE_RECAPTCHA_PRIVATE_KEY = '6LeuFQ0UAAAAAPHYQANQn7TBBBP9oqRg8cWMR8oK';

if (isset($_POST['g-recaptcha-response'])) {
    $params = [
        'secret' => GOOGLE_RECAPTCHA_PRIVATE_KEY,
        'response' => $_POST['g-recaptcha-response'],
        'remoteip'
    ];
    $curl = curl_init('https://www.google.com/recaptcha/api/siteverify?' . http_build_query($params));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $response = json_decode(curl_exec($curl));
    curl_close($curl);

    if (isset($response->success) && $response->success == true) {
        echo "Вы прошли проверку reCaptcha";
    } else {
        echo "Вы не прошли проверку reCaptcha";
    }
}