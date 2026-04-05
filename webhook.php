<?php
// webhook.php
$content = file_get_contents("php://input");
$data = json_decode($content, true);

if ($data && isset($data['content'])) {
    $file = 'messages.json';
    
    // Načteme stávající zprávy
    $current = json_decode(file_get_contents($file), true) ?? [];
    
    // Přidáme novou zprávu na začátek
    $newMessage = [
        'time' => date('H:i'),
        'date' => date('d.m.Y'),
        'text' => $data['content']
    ];
    
    array_unshift($current, $newMessage);
    
    // Uložíme jen posledních 10 zpráv
    $current = array_slice($current, 0, 10);
    
    file_put_contents($file, json_encode($current));
}
?>
