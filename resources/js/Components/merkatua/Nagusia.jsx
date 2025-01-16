import React, { useState, useEffect } from "react";
import { usePage } from "@inertiajs/react";
import Header from "./Header";
import Gidaria from "./Gidaria";
import Footer from "./Footer";

function Nagusia() {
  const { pilots = [] } = usePage().props; 
  const { guztiak = [] } = usePage().props;
  const { bezeroa } = usePage().props;
  const { liga } = usePage().props;

  const [pilotsList, setPilotsList] = useState(() => {
    const storedPilots = JSON.parse(localStorage.getItem("pilots") || "[]");
    const lastSelectTime = parseInt(localStorage.getItem("lastSelectTime"), 10);
    const currentTime = Date.now();

    if (
      storedPilots.length > 0 &&
      lastSelectTime &&
      currentTime - lastSelectTime < 86400000 
    ) {
      return storedPilots;
    }
    return pilots; 
  });

  const [timeLeft, setTimeLeft] = useState(() => {
    const lastSelectTime = parseInt(localStorage.getItem("lastSelectTime"), 10);
    const currentTime = Date.now();

    if (lastSelectTime) {
      const timePassed = Math.floor((currentTime - lastSelectTime) / 1000);
      return Math.max(86400 - timePassed, 0);
    }
    return 86400; // Tiempo completo en segundos
  });

  useEffect(() => {
    const storedPilots = JSON.parse(localStorage.getItem("pilots") || "[]");
    const lastSelectTime = parseInt(localStorage.getItem("lastSelectTime"), 10);
    const currentTime = Date.now();
    console.log('sartu da useeffect');
    console.log(storedPilots);
    if (
      storedPilots.length === 0 ||
      !lastSelectTime ||
      currentTime - lastSelectTime >= 86400000 
    ) {
      console.log(pilots);
      localStorage.setItem("pilots", JSON.stringify(pilots));
      localStorage.setItem("lastSelectTime", currentTime);
      setPilotsList(pilots);
    } else {
      setPilotsList(storedPilots);
    }
  }, [pilots]);

  useEffect(() => {
    const timer = setInterval(() => {
      setTimeLeft((prevTime) => Math.max(prevTime - 1, 0));
    }, 1000);

    return () => clearInterval(timer);
  }, []);

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
          {pilotsList.length > 0 ? (
            pilotsList.map((pilot) => <Gidaria key={pilot.id} pilot={pilot} />)
          ) : (
            <p>No hay pilotos disponibles</p>
          )}
        </div>
        <div className="saldototala">
          <p>FURY</p>
          -
        </div>
      </div>
      <div className="merkatuaFooter">
        <Footer />
      </div>
    </>
  );
}

export default Nagusia;
