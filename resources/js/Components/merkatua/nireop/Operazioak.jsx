import Taldea from './Taldea';
import Footer from '../Footer';
import Gidaria from './Gidaria';
import Header from './Header';
import flechaurdin from '@/../images/flechurdin.png';

import { usePage } from '@inertiajs/react';

function Operazioak() {
    const { gidariak = [] } = usePage().props;
    const { taldeak = null } = usePage().props;
    const { gidariakOferta = [] } = usePage().props;
    const { taldeakOferta = [] } = usePage().props;
    const { puja = [] } = usePage().props; 
    const { liga } = usePage().props;
    const { bezeroa } = usePage().props;
    console.log(taldeakOferta);
    const gidariakConPuja = gidariak.filter((gidaria) =>
        puja.some((p) => p.gidaria_id === gidaria.id)
    );

    return (
        <>
            <Header liga={liga} bezeroa={bezeroa}/>
            <div className='menu' style={{display:'flex'}}>
            <div className="salketaDiv">
                <img src={flechaurdin} alt="" />
                <a href='/nireoperazioak'>Erosketak</a>
            </div>
            <div className="pujakDiv">
                <img src='/images/flecharoja.png' alt="" />
                <a href='/salketak'>Salketak</a>
            </div>
            </div>

            {gidariakConPuja.length > 0 ? (
                gidariakConPuja.map((gidaria) => (
                    <Gidaria key={gidaria.id} pilot={gidaria} />
                ))
            ) : (
                null
            )}
            {gidariakOferta.length > 0 ? (
                gidariakOferta.map((gidaria) => (
                    <Gidaria key={gidaria.id} pilot={gidaria} />
                ))
            ) : (
                null
            )}
            {taldeak ? (
                <Taldea key={taldeak.id} taldea={taldeak} />
            ):(
                null
            )}
            {taldeakOferta.length > 0 ? (
                taldeakOferta.map((taldea) => (
                    <Taldea key={taldea.id} taldea={taldea} />
                ))
            ) : (
                null
            )}

            <Footer />
        </>
    );
}

export default Operazioak;
