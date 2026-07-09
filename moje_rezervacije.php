<?php
require_once 'inc/header.php';
?>
<main class="reservation-section">
    <div class="container">
        
        <div class="reservation-header">
            <h1 class="reservation-main-title">Moje rezervacije</h1>
            <p class="reservation-subtitle">Pregled svih vaših zakazanih termina i njihov trenutni status.</p>
        </div>

        <div class="table-responsive reservation-table-box">
            <table class="table reservation-table">
                <thead>
                    <tr>
                        <th>Kod rezervacije</th>
                        <th>Teren</th>
                        <th>Datum i vreme</th>
                        <th>Trajanje</th>
                        <th>Status</th>
                        <th>Napomena</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="reservation-code">#REV-84920</td>
                        <td class="reservation-court-name">Centralni Teniski Teren</td>
                        <td>12.07.2026. u 18:00h</td>
                        <td>60 min</td>
                        <td>
                            <span class="status-badge status-active">Potvrđeno</span>
                        </td>
                        <td class="reservation-note text-muted">Potrebni reketi</td>
                    </tr>
                    
                    <tr>
                        <td class="reservation-code">#REV-31049</td>
                        <td class="reservation-court-name">Fudbalski teren (Veštačka trava)</td>
                        <td>15.07.2026. u 20:30h</td>
                        <td>90 min</td>
                        <td>
                            <span class="status-badge status-pending">Na čekanju</span>
                        </td>
                        <td class="reservation-note text-muted">—</td>
                    </tr>

                    <tr>
                        <td class="reservation-code">#REV-11042</td>
                        <td class="reservation-court-name">Padel teren 1</td>
                        <td>05.07.2026. u 17:00h</td>
                        <td>30 min</td>
                        <td>
                            <span class="status-badge status-cancelled">Otkazano</span>
                        </td>
                        <td class="reservation-note text-muted">Loše vreme</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</main>
<?php
require_once 'inc/footer.php';
?>
