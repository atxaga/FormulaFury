import React, { useState, useEffect } from "react";
import { usePage } from "@inertiajs/react";
import Header from "./Header";
import Gidaria from "./Gidaria";
import Footer from "./Footer";
import euro from '@/../images/euroMerkatua.png';
import { Inertia } from '@inertiajs/inertia'; 

function Nagusia() {
  const { pilots = [] } = usePage().props; 
  const { guztiak = [] } = usePage().props;
  const { totalPuja } = usePage().props;
  const { bezeroa } = usePage().props;
  const { bezeroaDirua } = usePage().props;
  const { liga } = usePage().props;

  // Obtener la fecha actual en formato YYYY-MM-DD
  const getCurrentDate = () => {
    return new Date().toISOString().split("T")[0]; 
  };

  // Revisar si hay una fecha guardada
  const lastSelectDate = localStorage.getItem("lastSelectDate");
  const currentDate = getCurrentDate();

  useEffect(() => {
    if (lastSelectDate !== currentDate) {
      // Si la fecha cambió, reiniciar el mercado
      console.log("Reiniciando mercado...");
      localStorage.setItem("pilots", JSON.stringify(pilots));
      localStorage.setItem("lastSelectDate", currentDate);
      setPilotsList(pilots);
    } else {
      // Si la fecha es la misma, usar los datos guardados
      const storedPilots = JSON.parse(localStorage.getItem("pilots") || "[]");
      setPilotsList(storedPilots.length > 0 ? storedPilots : pilots);
    }
  }, [pilots]);

  const [pilotsList, setPilotsList] = useState(() => {
    const storedPilots = JSON.parse(localStorage.getItem("pilots") || "[]");
    return storedPilots.length > 0 ? storedPilots : pilots;
  });

  const calculateTimeLeft = () => {
    const now = new Date();
    const midnight = new Date();
    midnight.setHours(24, 0, 0, 0);
    return Math.floor((midnight - now) / 1000); 
  };

  const [timeLeft, setTimeLeft] = useState(calculateTimeLeft());

  useEffect(() => {
    const timer = setInterval(() => {
      setTimeLeft((prevTime) => Math.max(prevTime - 1, 0));
    }, 1000);

    return () => clearInterval(timer);
  }, []);

  useEffect(() => {
    if (timeLeft === 0) {
      Inertia.get('/merkatubukaera');
      window.location.reload();
    }
  }, [timeLeft]);

  const formatTime = (seconds) => {
    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const secs = seconds % 60;

    return `${hours.toString().padStart(2, "0")}:${minutes
      .toString()
      .padStart(2, "0")}:${secs.toString().padStart(2, "0")}`;
  };

  return (
    <>
      <div className="main-merkatua">
        <Header guztiak={guztiak} bezeroa={bezeroa} liga={liga} />
        <div className="countdown">
          <p className="countdown-text">
            Merkatu bukaera: {formatTime(timeLeft)}
          </p>
        </div>
        <div className="pilots-list">
          {pilots.length > 0 ? (
            pilots.map((pilot) => <Gidaria key={pilot.id} pilot={pilot} bezeroaDirua = {bezeroaDirua} />)
          ) : (
            <p>No hay pilotos disponibles</p>
          )}
        </div>
        <div className="saldototala">
          <p>FURY</p>
          <div className="divpuja">
            <div className="saldoDiv">
              <p className="dirua">{bezeroaDirua}</p>
              <img src={euro} alt="" />
            </div>
            <div className="puja">
              {totalPuja > 0 ? (
                <>
                  <p className="diruaminus">-{totalPuja}</p>  
                  <p className="diruaminus2">{bezeroaDirua - totalPuja}</p>
                </>
              ) : null}
            </div>
          </div>
        </div>
      </div>
      <div className="merkatuaFooter">
        <Footer />
      </div>
    </>
  );
}

export default Nagusia;
