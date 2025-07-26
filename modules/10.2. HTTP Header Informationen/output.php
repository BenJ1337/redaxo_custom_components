<?php
$properties["SERVER_PROTOCOL"] = $_SERVER["SERVER_PROTOCOL"];
$properties["HTTP_ACCEPT"] = $_SERVER["HTTP_ACCEPT"];
$properties["HTTP_ACCEPT_LANGUAGE"] = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
$properties["HTTP_ACCEPT_ENCODING"] = $_SERVER["HTTP_ACCEPT_ENCODING"];
$properties["HTTP_CONNECTION"] = $_SERVER["HTTP_CONNECTION"];
$properties["SERVER_PORT"] = $_SERVER["SERVER_PORT"];
$properties["REMOTE_PORT"] = $_SERVER["REMOTE_PORT"];
$properties["SERVER_PROTOCOL"] = $_SERVER["SERVER_PROTOCOL"];
$properties["REQUEST_METHOD"] = $_SERVER["REQUEST_METHOD"];
$properties["REQUEST_TIME_FLOAT"] = $_SERVER["REQUEST_TIME_FLOAT"];
$properties["REQUEST_TIME"] = $_SERVER["REQUEST_TIME"];
$properties["QUERY_STRING"] = $_SERVER["QUERY_STRING"];
$properties["REMOTE_ADDR"] = $_SERVER["REMOTE_ADDR"];
$properties["HTTP_USER_AGENT"] = $_SERVER["HTTP_USER_AGENT"];

echo '<table class="table table-striped">
    <thead>
      <tr>
        <th>Eigenschaft</th>
        <th>Wert</th>
      </tr>
    </thead>
    <tbody>';
foreach ($properties as $key => $value) {
    echo '<tr>
	        <td>' . $key . '</td>';
    if (preg_match('/.*TIME.*/', $key)) {
        $timeStr = '';
        try {
            $timeStr = date('d.m.Y H:m:s', round($value));
        } catch (Exception $e) {
            $timeStr = '*';
        }
        echo '<td>' . $value . ' (' . $timeStr . ')</td>';
    } else {
        echo '<td>' . $value . '</td>';
    }
    echo '</tr>';
}

echo '</tbody>
  </table>';
