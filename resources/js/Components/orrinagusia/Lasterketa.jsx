import { useEffect } from 'react';
import Losail from '../../../images/Losail-removebg-preview.png';
import { usePage } from '@inertiajs/react';

function Lasterketa() {
  const { translations } = usePage().props;

  useEffect(() => {
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
          console.log(`Script cargado: ${src}`);
          loadedScripts += 1;
          if (loadedScripts === scripts.length) {
            console.log('Todos los scripts se han cargado correctamente');
            initializeMap();
          }
        };
        script.onerror = () => {
          console.error(`Error al cargar el script: ${src}`);
        };
        document.body.appendChild(script);
      });
    };

    loadScripts();

    return () => {
      const scripts = document.querySelectorAll('script[src*="mapsjs"]');
      scripts.forEach((script) => script.remove());
    };
  }, []);

  const initializeMap = () => {
    try {
      console.log('Inicializando el mapa...');
      const apiKey = "MG38gQjUkrKVnS9MqZIncYbjffHyeuRzd7r8VWOk0lQ";

      const platform = new H.service.Platform({
        apikey: apiKey,
      });

      const defaultLayers = platform.createDefaultLayers();
      const circuitCoords = { lat: 25.4889, lng: 51.4544 };

      const map = new H.Map(
        document.getElementById("mapContainer"),
        defaultLayers.vector.normal.map,
        {
          zoom: 15,
          center: circuitCoords,
        }
      );

      const behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
      const ui = H.ui.UI.createDefault(map, defaultLayers);

      const marker = new H.map.Marker(circuitCoords);
      map.addObject(marker);

      marker.addEventListener("tap", () => {
        const googleMapsUrl = `https://www.google.com/maps?q=${circuitCoords.lat},${circuitCoords.lng}`;
        window.open(googleMapsUrl, "_blank");
      });

      const bubble = new H.ui.InfoBubble(circuitCoords, {
        content: "<b>Losail International Circuit</b><br>F1 GP de Catar",
      });
      ui.addBubble(bubble);

      console.log('Mapa inicializado correctamente');
    } catch (error) {
      console.error('Error al inicializar el mapa:', error);
    }
  };

  return (
    <>
      <div className='container'>
        
        <div className='hurrengo'>
          <p>{translations.nagusia.hurrengola}</p>
        </div>
        <div className='blanco'>
        <div>
          <div className='lasterketa'>
            <p>GP CATAR</p>
            <div className='datuak'>
              <p>DOM, 1 DIC, 17:00</p>
              <p>CIRCUITO INTERNACIONAL DE LOSAIL</p>
            </div>
          </div>
          
        </div>
        <div className='circuito'>
          <div id="mapContainer" style={{ width: '100%', height: '260px' }}></div>
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
