<div class="container">
  <div class="row row-offcanvas-sm row-offcanvas-sm-right margin-top overflow-visible">

    <!-- main section -->
    <div class="col-xs-12 col-sm-12 col-md-8 ">
      <section id="content" class="article-box">
        <div class="row">

          <div class="col-xs-12 col-md-12 blog-item blog-single">
            <!--
            ***************************************************************************************************

              BEGIN: Website Search UI

            ***************************************************************************************************
            -->

            <!-- This div is used to host the search box -->
            <div id="results-search-box"></div>

            <h1 class="rounded">myDr Search results for "<?php echo $searchText; ?>"</h1>

            <!-- This div is used to host the search response -->
            <div id="results-search-response"></div>

            <script>
              var getUrlParam = function (e) { var t = new RegExp("[?&]" + e.replace(/[\[\]]/g, "\\$&") + "(=([^&#]*)|&|#|$)"), a = t.exec(window.location.href); return a && a[2] ? decodeURIComponent(a[2].replace(/\+/g, " ")) : "" };

              var setup = function (w, d, x, a, e, s, c, r) { s = []; var b = function () { s.push(arguments); }, q = "ui"; b.arr = s; w[a] = w[a] || []; w[a][q] = w[a][q] || []; w[a][q].push(b); c = d.createElement(x); c.async = 1; c.src = e; r = d.getElementsByTagName(x)[0]; r.parentNode.insertBefore(c, r); return b; };

              var searchInterface = setup(window, document, "script", "sajari", "https://cdn.sajari.com/js/integrations/website-search-1.3.0.js");
              searchInterface("inline", {
                project: "drmeptyltd",
                collection: "mydr",
                pipeline: "website",
                instantPipeline: "autocomplete",
                attachSearchBox: document.getElementById("results-search-box"),
                attachSearchResponse: document.getElementById("results-search-response"),
                overlay: false,
                inputPlaceholder: "Search myDr website",
                inputAutoFocus: false,
                maxSuggestions: 5,
                results: { "showImages": true },
                tabFilters: { defaultTab: "All", tabs: [{ title: "All", filter: "" }, { title: "Medicines", filter: "dir1='medicines' AND dir2='cmis'" }, { title: "Tools", filter: "dir1='tools'" }] },
                values: { "q.override": true, "resultsPerPage": "10", "q": getUrlParam("q") }
              });
            </script>

            <!--
            ***************************************************************************************************

              END: Website Search UI

            ***************************************************************************************************
            -->
          </div>
        </div>

      </section>
    </div>
  <!-- End main section -->

    <?= $this->element('sidebar') ?>

  </div>
</div>
