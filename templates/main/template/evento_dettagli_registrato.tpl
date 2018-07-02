<div class="corner-content-1col-top"></div>
<div class="content-1col-nobox">
    <h1>{$dati.nome}</h1>
    <h5>{$dati.username}</h5>
    <p><img height="200" src="foto/{$dati.foto}" alt="{$dati.nome}" title="{$dati.nome}">{$dati.descrizione}</p>
    {section name=i loop=$dati.commento}
        {assign var="somma" value="`$dati.commento[i].voto+$somma`"}
        {assign var="max" value="`$smarty.section.i.max`"}
    {/section}
    <p class="details"><b>Vino:</b> | {$dati_vino.nome} di {$dati_vino.produttore} ({$dati_vino.annata}) | </p>          
    <p class="details"><b>Organizzatore:</b> | {$dati.utente|ucfirst} | </p>          
    <p class="details"><b>Data evento:</b> | {$dati.data|date_format:"%A %e %B %Y %H:%M"} | </p>
    <p class="details"><b>Data fine iscrizioni:</b> | {$dati.data_chiusura|date_format:"%A %e %B %Y %H:%M"} |</p>
    <p class="details"><b>Posti disponibili:</b> | {$dati.posti} | Posti totali ({$dati.posti})</p>
    <p class="details"><b>Location:</b> | {$dati_location.indirizzo} | {$dati_location.citta} |</p>
    <p class="details"><b>Media Voti:</b> | <a href="#">{if $max>0}{$somma/$max|string_format:"%.2f"}{else}-{/if}</a> | Prezzo: <a href="#">{$dati.prezzo}</a> |</p>
    <form action="index.php" method="post">
        <input type="hidden" name="id_evento" value="{$dati.id}" />
        <input id="button" type="submit" name="task" value="Partecipa" />
        <input type="hidden" name="controller" value="evento" />
    </form>
    {section name=j loop=$dati.partecipante}
        <blockquote>
            <p>{$dati.partecipante[j].nome}</p>
            <p>voto: {$dati.partecipante[j].cognome}</p>
        </blockquote>
    {/section}
</div>
<div class="corner-content-1col-bottom"></div>
