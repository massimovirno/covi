        <a id="anchor-contact-1"></a>
        <div class="corner-content-1col-top"></div>        
        <div class="content-1col-nobox">
          <h1 class="contact">Creazione Evento</h1>
          <div class="contactform">
            <form method="post" action="index.php">
              <fieldset><legend>&nbsp;INFORMAZIONI PRINCIPALI&nbsp;</legend>
                <p><label for="nome" class="left">Nome evento:</label>
                   <input type="text" name="nome" id="nome" class="field" value="" tabindex="5" /></p>
                <p><label for="data" class="left">Data:</label>
                   <input type="date" name="data" id="data" class="field" value="" tabindex="6" /></p>
                <p><label for="vino" class="left">Vino:</label>
                   <input type="text" name="vino" id="vino" class="field" value="" tabindex="7" /></p>
                <p><label for="posti" class="left">Posti:</label>
                   <input type="text" name="posti" id="posti" class="field" value="" tabindex="8" /></p>
                <p><label for="prezzo" class="left">Prezzo:</label>
                   <input type="text" name="prezzo" id="prezzo" class="field" value="" tabindex="9" /></p>                
              </fieldset>
              <fieldset><legend>&nbsp;DETTAGLI&nbsp;</legend>
                <p><label for="descBreve" class="left">Descrizione breve:</label>
                   <input type="text" name="descbreve" id="descbreve" class="field" value="" tabindex="10" /></p>
                <p><label for="descrizione" class="left">Descrizione:</label>
                   <input type="text" name="descrizione" id="descrizione" class="field" value="" tabindex="11" /></p>                
                <p><label for="location" class="left">Location:</label>
                   <input type="text" name="location" id="location" class="field" value="" tabindex="12" /></p>
                <p><label for="data_chiusura" class="left">Data scad.prenot.:</label>
                   <input type="date" name="data_chiusura" id="data_chiusura" class="field" value="" tabindex="13" /></p>             
                <p><label for="foto" class="left">Upload foto:</label>
                   <input type="foto" name="foto" id="foto" class="field" value="" tabindex="14" /></p>
                
                <input type="hidden" name="controller" value="creazioneevento" />
                <input type="hidden" name="task" value="salvaevento" />
                <p><input type="submit" name="submit" id="submit_1" class="button" value="Salva" tabindex="15" /></p>
               </fieldset>
            </form>
          </div>
        </div>
        <div class="corner-content-1col-bottom"></div>