import Footer from '../Footer';
import Gidaria from './Gidaria';
import Header from './Header';
import flechaurdin from '@/../images/flechurdin.png';
import { usePage } from '@inertiajs/react';
import '@/../css/nireop/nagusia.css';

function Operazioak() {
    const { gidariak = [] } = usePage().props;
    const { puja = [] } = usePage().props; 
    const { liga } = usePage().props;
    const { bezeroa } = usePage().props;

    const gidariakConPuja = gidariak.filter((gidaria) =>
        puja.some((p) => p.gidaria_id === gidaria.id)
    );

    return (
        <>
            <Header liga={liga} bezeroa={bezeroa}/>
            <div className="pujakDiv">
                <img src={flechaurdin} alt="" />
                <p>Erosketak</p>
            </div>

            {gidariakConPuja.length > 0 ? (
                gidariakConPuja.map((gidaria) => (
                    <Gidaria key={gidaria.id} pilot={gidaria} />
                ))
            ) : (
                <h1>Ez duzu pujarik</h1>
            )}

            <Footer />
        </>
    );
}

export default Operazioak;
