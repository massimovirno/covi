    <div class="corner-content-1col-top"></div>
    <div class="content-1col-nobox">
    <h1>Location</h1>
        {if $dati!= false}
            <table id="carrello">
                <tr>
                    <th class="top" scope="col">ID</th>
                    <th class="top" scope="col">Citta</th>
                    <th class="top" scope="col">Indirizzo</th>
                    {section name=i loop=$dati.oggetti}
                        <tr>
                            <th scope="row">{$dati.oggetti[i].ID}</th>
                            <td>{$dati.oggetti[i].citta}</td>
                            <td>{$dati.oggetti[i].indirizzo}</td>				
                        </tr>
                    {/section}
                </tr>
            </table>
        {else}
            <p>Nessuna Location inserita</p>
        {/if}
    </div>
    <div class="corner-content-1col-bottom"></div>
