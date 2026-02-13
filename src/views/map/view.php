<?php $title="Carte"; require __DIR__ . '/../layout/header.php'; ?>

<div class="card">
  <h1>Carte — La Réunion</h1>
  <p class="muted">Les points viennent de la collection <b>venues</b>. Les activités/avis sont chargés depuis MongoDB.</p>
</div>

<div class="card" style="padding:0;">
  <div id="map" style="height:78vh; width:100%; border-radius:10px;"></div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
  const map = L.map('map').setView([-21.1151, 55.5364], 10);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; OpenStreetMap'
  }).addTo(map);

  async function load() {
    const res = await fetch('/api/map.php');
    const data = await res.json();

    data.venues.forEach(v => {
      if (v.lat == null || v.lng == null) return;

      const marker = L.marker([v.lat, v.lng]).addTo(map);

      let html = `<b>${v.name}</b> (${v.city})<br>`;

      // avis lieu
      if (v.venueReviews && v.venueReviews.length > 0) {
        html += `<div><i>Avis lieu:</i> ${v.venueReviews.map(r => `⭐${r.rating}/5 ${r.comment}`).join(" | ")}</div>`;
      }

      // activités
      if (!v.activities || v.activities.length === 0) {
        html += `<div>Aucune activité liée</div>`;
      } else {
        html += `<ul>`;
        v.activities.forEach(a => {
          html += `<li><b>${a.title}</b> — ${a.category} (${a.difficulty || ''})`;
          if (a.reviews && a.reviews.length > 0) {
            html += `<br><i>Avis activité:</i> ${a.reviews.map(r => `⭐${r.rating}/5 ${r.comment}`).join(" | ")}`;
          }
          html += `</li>`;
        });
        html += `</ul>`;
      }

      marker.bindPopup(html);
    });
  }

  load();
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
