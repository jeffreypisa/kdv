import $ from "jquery";

export function ubncheck() {
  if (!$("#submitbutton").length) return;

  document.getElementById("submitbutton").onclick = function (e) {
    e.preventDefault();

    const $out = $("#ubnoutput").html("");
    const ubn = String(document.getElementById("ubn").value || "").trim();

    // (optioneel) simpele inputcheck
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
            "<tr><td>UBN:</td><td>" + d.ubn + "</td></tr>" +
            "<tr><td>Status:</td><td>" + d.status + "</td></tr>" +
            "<tr><td>Concept:</td><td>" + d.concept + "</td></tr>" +
            "</table>";
          $out.html(html);
          return;
        }

        // API gaf bv. { "message": "Something went wrong" } terug
        $out.html("<p>This is not a valid UBN number</p>");
      })
      .fail(function () {
        // HTTP/timeout/netwerkfout
        $out.html("<p>An error has occurred</p>");
      });
  };
}