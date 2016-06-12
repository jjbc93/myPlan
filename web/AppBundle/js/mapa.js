define([
    "esri/views/MapView",
    "esri/WebMap",
    "dojo/on",
    "dojo/domReady!"
], function(
       MapView, WebMap,
        on
       ) {
    return {
        var webmapids = [
        "f2e9b762544945f390ca4ac3671cfa72",
        "b7641f0a6bb641aebcd817f4f72fbe7b",
        "077a689e3d834444973541a374663fe8",
        "ec2710e10b784a37954986bcd42778cf"
    ];

    /************************************************************
       * Crear un Mapa con multiples instancias
       ************************************************************/
    var webmaps = webmapids.map(function(webmapid) {
        return new WebMap({
            portalItem: {
                id: webmapid
            }
        });
    });

    /************************************************************
       * Iniciar el primer mapa
       ************************************************************/
    var view = new MapView({
        map: webmaps[0],
        container: "viewDiv"
    });
    on(document.querySelector(".btns"), ".btn-switch:click", function(e) {
        /************************************************************
         * Seleccionar un mapa en función del div marcado
         ************************************************************/
        var id = e.target.getAttribute("data-id");
        if (id) {
            var webmap = webmaps[id];
            view.map = webmap;
            var nodes = document.querySelectorAll(".btn-switch");
            for (var idx = 0; idx < nodes.length; idx++) {
                var node = nodes[idx];
                var mapIndex = node.getAttribute("data-id");
                if (mapIndex === id) {
                    node.classList.add("active-map");
                } else {
                    node.classList.remove("active-map");
                }
            }
        }
    });
    }
    
});