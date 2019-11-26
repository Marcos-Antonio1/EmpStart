<?php
echo "chegou aqui\n";
$uploaddir = '/var/www/html/ProjetoPOO/Views/';
$uploadfile = $uploaddir . basename($_FILES['qualquer']['name']);

if (move_uploaded_file($_FILES['qualquer']['tmp_name'], $uploadfile)) {
    echo "Arquivo válido e enviado com sucesso.\n";
} else {
    echo "Possível ataque de upload de arquivo!\n";
}