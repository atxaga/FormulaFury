import { useEffect } from 'react';
import Losail from '../../../images/Losail-removebg-preview.png';
import { usePage } from '@inertiajs/react';

function Lasterketa() {
  const { translations } = usePage().props;

  useEffect(() => {
    // Función para cargar los scripts necesarios
    const loadScripts = () => {
      const scripts = [
        "https://js.api.here.com/v3/3.1/mapsjs-core.js",
        "https://js.api.here.com/v3/3.1/mapsjs-service.js",
        "https://js.api.here.com/v3/3.1/mapsjs-ui.js",
        "https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"
      ];

      let loadedScripts = 0;

      scripts.forEach((src) => {
        const script = document.createElement('script');
        script.src = src;
        script.async = true;
        script.onload = () => {
          loadedScripts += 1;
          // Cuando todos los scripts se hayan cargado, inicializamos el mapa
          if (loadedScripts === scripts.length) {
            initializeMap();
          }
        };
        document.body.appendChild(script);
      });
    };

    // Cargar los scripts
    loadScripts();

    return () => {
      // Limpiar los scripts cuando el componente se desmonte
      const scripts = document.querySelectorAll('script[src*="mapsjs"]');
      scripts.forEach((script) => script.remove());
    };
  }, []);

  const initializeMap = () => {
    // Aquí se encuentra la clave de la API de HERE
    const apiKey = "MG38gQjUkrKVnS9MqZIncYbjffHyeuRzd7r8VWOk0lQ";

    // Crear la plataforma de HERE
    const platform = new H.service.Platform({
      apikey: apiKey,
    });

    // Crear las capas del mapa
    const defaultLayers = platform.createDefaultLayers();

    // Coordenadas del circuito Losail
    const circuitCoords = { lat: 25.4889, lng: 51.4544 };

    // Crear el mapa
    const map = new H.Map(
      document.getElementById("mapContainer"),
      defaultLayers.vector.normal.map,
      {
        zoom: 15,
        center: circuitCoords,
      }
    );

    // Crear la interacción del usuario con el mapa
    const behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

    // Crear la interfaz del usuario en el mapa
    const ui = H.ui.UI.createDefault(map, defaultLayers);

    // Agregar el marcador en la ubicación de Losail
    const marker = new H.map.Marker(circuitCoords);
    map.addObject(marker);

    // Agregar el evento de clic al marcador para abrir Google Maps
    marker.addEventListener("tap", () => {
      const googleMapsUrl = `https://www.google.com/maps?q=${circuitCoords.lat},${circuitCoords.lng}`;
      window.open(googleMapsUrl, "_blank");
    });

    // Mostrar una burbuja de información sobre el marcador
    const bubble = new H.ui.InfoBubble(circuitCoords, {
      content: "<b>Losail International Circuit</b><br>F1 GP de Catar",
    });
    ui.addBubble(bubble);
  };

  return (
    <>
      <div className='container'>
        <div className='hurrengo'>
          <p>{translations.nagusia.hurrengola}</p>
        </div>
        <div className='blanco'>
          <div className='lasterketa'>
            <p>GP CATAR</p>
            <div className='datuak'>
              <p>DOM, 1 DIC, 17:00</p>
              <p>CIRCUITO INTERNACIONAL DE LOSAIL</p>
            </div>
          </div>
          <div className='circuito'>
            {/* Aquí ponemos el contenedor donde cargaremos el mapa */}
            <div id="mapContainer" style={{ width: '100%', height: '250px' }}></div>
          </div>
        </div>
        <div className='kontaktatu1'>
          <p>{translations.nagusia.kontaktatu}</p>
        </div>
        <div className='blanco2'>
          <div className='kontakt'>
            <p>{translations.nagusia.iritzia}</p>
            <button className='sortuLiga'>
              <a href="../../kontaktua">{translations.nagusia.kontaktatu2}</a>
            </button>
          </div>
        </div>
      </div>
    </>
  );
}

export default Lasterketa;
