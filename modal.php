<?php
$eventos = [
    [
        "nome" => "Monsters Of Rock",
        "data" => "26/04/2025"
    ],
    [
        "nome" => "Lady Gaga",
        "data" => "30/04/2025"
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button>Abre modal</button>

    <dialog>
        <h2>Qualquer coisa</h2>
        <p>lorem</p>
        <hr>
        <h3><?=$eventos[0]["nome"]?></h3>

        <button>Fechar</button>
    </dialog>

<script>
    const botao = document.querySelector("button");
    const janela = document.querySelector("dialog");
    const fechar = document.querySelector("dialog button");

    botao.addEventListener("click", function(){
        janela.showModal()
    })

    fechar.addEventListener("click", function(){
        janela.close();
    })
</script>

</body>
</html>