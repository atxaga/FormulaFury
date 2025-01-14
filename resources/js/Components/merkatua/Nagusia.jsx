import { useState, useEffect } from 'react';
import { usePage } from '@inertiajs/react';
import '../../../css/merkatuaOrria/nagusia.css';
import Footer from './Footer';
import Header from './Header';
import Gidaria from './Gidaria';

function Nagusia() {
  const { pilots = [] } = usePage().props;
  const {guztiak = []} = usePage().props;

  const storedPilots = JSON.parse(localStorage.getItem('pilots'));
  const lastSelectTime = parseInt(localStorage.getItem('lastSelectTime'), 10);
  const currentTime = Date.now();

  const [pilotsList, setPilotsList] = useState(() => {
    if (storedPilots && lastSelectTime && currentTime - lastSelectTime < 86400000) {
      return storedPilots;
    }
    return pilots;
  });

  const [timeLeft, setTimeLeft] = useState(() => {
    if (lastSelectTime) {
      const timePassed = Math.floor((currentTime - lastSelectTime) / 1000);
      return 86400 - timePassed > 0 ? 86400 - timePassed : 0;
    }
    return 86400;
  });

  useEffect(() => {
    if (!storedPilots || !lastSelectTime || currentTime - lastSelectTime >= 86400000) {
      localStorage.setItem('pilots', JSON.stringify(pilots));
      localStorage.setItem('lastSelectTime', currentTime);
      setPilotsList(pilots);
    }
  }, [pilots, storedPilots, lastSelectTime, currentTime]);

  useEffect(() => {
    const timer = setInterval(() => {
      setTimeLeft((prevTime) => (prevTime > 0 ? prevTime - 1 : 0));
    }, 1000);

    return () => clearInterval(timer);
  }, []);

  const formatTime = (seconds) => {
    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const secs = seconds % 60;

    return `${hours.toString().padStart(2, '0')}:${minutes
      .toString()
      .padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
  };

  return (
    <>
      <div className="main-merkatua">
        <Header guztiak = {guztiak}/>
        <div className="countdown">
          <p className="countdown-text">Merkatu bukaera: {formatTime(timeLeft)}</p>
        </div>

        <div className="pilots-list">
          {pilotsList.length > 0 ? (
            pilotsList.map((pilot) => (
              <Gidaria key={pilot.id} pilot={pilot} />
            ))
          ) : (
            <p>No hay pilotos disponibles</p>
          )}
        </div>
        <div className="saldototala">
          <p>FURY</p>
          -
        </div>
      </div>
      <div className='merkatuaFooter'>
      <Footer />
      </div>
    </>
  );
}

export default Nagusia;
