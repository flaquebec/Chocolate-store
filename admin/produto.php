<?php
require 'header.php';?>

   <div class="cadastro container-fluid mt-5 col-xs-12 col-sm-6 col-md-6 col-lg-6 mt-0">
      <p class="text-center">Produto</p>
    </div>
    
  <div class="container-fluid cadastroBox col-xs-12 col-sm-6 col-md-6 col-lg-6">
   
   
   
    <form action="/action_page.php">
      <div class="form-group">
        <label for="name">Nome:</label>
        <input type="" class="form-control" id="nome" value="" placeholder="" name="email">
      </div>

     
      <div class="form-group">
        <label for="catergoria">Categoria</label>
        <select class="form-control" id="exampleFormControlSelect1">
          <option></option>
          <option>Produto A</option>
          <option>Produto b</option>
          <option>Produto c</option>
          <option>Produto d</option>
          <option>Produto e</option>
          
        </select>
      </div>
      
      <div class="form-group">
        <label for="comment">Descrição:</label>
        <textarea class="form-control" rows="5" id="comment"></textarea>
      </div>    
             
      <div class="form-group">
        <label for="Imagem">Imagem:</label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="inputGroupFile04">
            <label class="custom-file-label" for="inputGroupFile04"></label>
          </div>
        </div>
      </div>  
     
        <button onclick="btnSalvar()"  type="button" class="btnSalvarCancelar btn btn-secondary btn-inline-block">Salvar</button>
        <button onclick="btnCancelar()" type="button" class="btnSalvarCancelar btn btn-secondary btn-inline-block float-right">Cancelar</button>
      
    </form>
  </div>
  

  <?php
require 'footer.php';?>