import $ from "jquery";

export function ubncheck() {
  if (!$("#submitbutton").length) return;

  document.getElementById("submitbutton").onclick = function (e) {
    e.preventDefault();

    const $out = $("#ubnoutput").html("");
    const ubn = String(document.getElementById("ubn").value || "").trim();

    // simpele inputcheck
    if (!/^\d{7}$/.test(ubn)) {
      $out.html("<p>This is not a valid UBN number</p>");
      return;
    }

    $.ajax({
      url: "https://api.mijnwestfort.nl/company/status/" + ubn,
      method: "GET",
      dataType: "json",
      timeout: 8000
    })
      .done(function (data) {
        // Succespad met data.data
        if (data && data.data && data.data.ubn) {
          const d = data.data;
          const html =
            "<table>" +
            "<tr><td>UBN:</td><td>" + (d.ubn ?? "-") + "</td></tr>" +
            "<tr><td>Status:</td><td>" + (d.status ?? "-") + "</td></tr>" +
            "<tr><td>Concept:</td><td>" + (d.concept ?? "-") + "</td></tr>" +
            "</table>";
          $out.html(html);
          return;
        }

        // API antwoordt wel, maar geen match (bijv. {message: "..."} of lege data)
        $out.html("<p>This number is not in our database</p>");
      })
      .fail(function (jqXHR, textStatus) {
        // 404 of een bekend "not found"-antwoord → niet in database
        const msg = jqXHR?.responseJSON?.message || "";
        if (jqXHR.status === 404 || /not\s*found/i.test(msg) || msg) {
          $out.html("<p>This number is not in our database</p>");
          return;
        }

        // echte technische fout (timeout/netwerk/server)
        if (textStatus === "timeout" || jqXHR.status >= 500 || jqXHR.status === 0) {
          $out.html("<p>An error has occurred</p>");
          return;
        }

        // fallback
        $out.html("<p>An error has occurred</p>");
      });
  };
}