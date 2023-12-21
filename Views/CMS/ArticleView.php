<?php
class ArticleView
{
    public function renderEditor()
    {

        echo <<<HTML
      <form method="POST" action="/create-article">
        <div class="form-group">
          <label for="title">Temat Lekcji</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Podaj temat lekcji">
        </div>
        <div class="form-group">
        <label for="category">Wybierz przedmiot</label>
        <input list="category" name="category" />
            <datalist id="category" />
                <option value="Systemy Operacyjne" />
                <option value="Lokalne Sieci Komputerowe" />
                <option value="Urządzenia Techniki Komputerowej" />
            </datalist>
        </div>
        <div class="form-group">
          <label for="content">Content</label>
          <div id="editor-quill"></div>
          <input type="text" id="content" name="content">
        </div>
        <button type="submit" class="btn btn-primary">Create article</button>
      </form>
      <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
      <!--
        // TODO: zbudować edytor quill.js 
        <input type="hidden" id="content" name="content">
      -->
    HTML;
    }

    public function renderArticle($article)
    {
        echo $article;
    }
}
