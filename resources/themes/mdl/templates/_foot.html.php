        </div>
      </main>
      <footer class="mdl-mini-footer">
        <div class="mdl-mini-footer__left-section">
          <div class="mdl-logo">Egzaminer</div>
          <ul class="mdl-mini-footer__link-list">
            <li><a href="https://github.com/mklkj/egzaminer">GitHub</a></li>
            <li><a href="https://github.com/mklkj/egzaminer/issues">Report issue</a></li>
          </ul>
        </div>
      </footer>
    </div>
    <script src="<?=$this->dir();?>/assets/mdl/main.js"></script>

<?php if (isset($this->data['valid'])) : ?>
  <div id="demo-toast-example" class="mdl-js-snackbar mdl-snackbar">
      <div class="mdl-snackbar__text"></div>
      <button class="mdl-snackbar__action" type="button"></button>
    </div>
    <script>
      window.addEventListener('load', function(){
        var notification = document.querySelector('.mdl-js-snackbar');
        notification.MaterialSnackbar.showSnackbar({
            message: '<?=$this->data['valid'] ? 'Operacja powiodła się!' : 'Operacja nie powiodła się!';?>'
        });
      });
  </script>
<?php endif ?>

  </body>
</html>