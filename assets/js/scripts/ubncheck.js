import $ from "jquery";

export function ubncheck() {
  if (!$("#submitbutton").length) return;

  document.getElementById("submitbutton").onclick = function (e) {
    e.preventDefault();

    var $out = $("#ubnoutput").html("");
    var ubn = String(document.getElementById("ubn").value || "").trim();

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
          var d = data.data;
          var html =
            "<table>" +
            "<tr><td>UBN:</td><td>" + (d.ubn ? d.ubn : "-") + "</td></tr>" +
            "<tr><td>Status:</td><td>" + (d.status ? d.status : "-") + "</td></tr>" +
            "<tr><td>Concept:</td><td>" + (d.concept ? d.concept : "-") + "</td></tr>" +
            "</table>";
          $out.html(html);
          return;
        }

        // API antwoordt wel, maar geen match (bijv. {message:"..."} of lege data)
        $out.html("<p>This number is not in our database</p>");
      })
      .fail(function (jqXHR, textStatus) {
        var respJSON = (jqXHR && jqXHR.responseJSON) ? jqXHR.responseJSON : null;
        var msg = respJSON && respJSON.message ? respJSON.message : "";

        // 404 of een (herkenbare) not-found boodschap → niet in database
        if (jqXHR && jqXHR.status === 404) {
          $out.html("<p>This number is not in our database</p>");
          return;
        }
        if (msg && /not\s*found/i.test(msg)) {
          $out.html("<p>This number is not in our database</p>");
          return;
        }
        if (msg && !/error|exception|timeout/i.test(msg)) {
          // Als de API iets generieks teruggeeft maar niet duidelijk technisch is
          $out.html("<p>This number is not in our database</p>");
          return;
        }

        // echte technische fout (timeout/netwerk/5xx/0)
        if (textStatus === "timeout" || (jqXHR && (jqXHR.status >= 500 || jqXHR.status === 0))) {
          $out.html("<p>An error has occurred</p>");
          return;
        }

        // fallback
        $out.html("<p>An error has occurred</p>");
      });
  };
}