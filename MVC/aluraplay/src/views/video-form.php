<?php
require_once __DIR__.'/inicio-html.php';

?>

<main class="container">
    <form class="container__formulario" 
        method="post"
    >
        <h2 class="formulario__titulo">Envie um vídeo!</h2>
            <div class="formulario__campo">
                <label class="campo__etiqueta" for="url">Link embed</label>
                <input 
                    id='url' 
                    name="url" 
                    value="<?= $video['url'];?>"
                    class="campo__escrita" 
                    placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" 
                    required
                />
            </div>


            <div class="formulario__campo">
                <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                <input 
                    id='titulo' 
                    name="titulo"
                    value="<?= $video['title'];?>"
                    class="campo__escrita"
                    placeholder="Neste campo, dê o nome do vídeo"
                    required 
                />
            </div>

            <input class="formulario__botao" type="submit" value="Enviar" />
    </form>
</main>

<?php require_once __DIR__.'/fim-html.php';