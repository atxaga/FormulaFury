import Footer from '../Footer';
import Gidaria from './GidariaSaldu';
import Header from './Header';
import flechaurdin from '@/../images/flechurdin.png';

import { usePage } from '@inertiajs/react';
import '@/../css/nireop/ofertak.css';
import Taldea from '@/Components/gidariaBezero/Taldea';
import TaldeaSaldu from './TaldeaSaldu';

function Ofertak() {
    const { gidarias = [] } = usePage().props;
    const { puja = [] } = usePage().props; 
    const { liga } = usePage().props;
    const { taldeak = []} = usePage().props;
    const { bezeroa } = usePage().props;
    const { erabiltzailea } = usePage().props;
   
    console.log(taldeak);


    return (
        <>  
            <div style={{marginBottom:'10%'}}>
            <Header liga={liga} bezeroa={bezeroa} erabiltzailea={erabiltzailea}/>
            <div className='menu' style={{display:'flex'}}>
            <div className="pujakDiv">
                <img src={flechaurdin} alt="" />
                <a href='/nireoperazioak'>Erosketak</a>
            </div>
            <div className="salketaDiv">
                <img src='/images/flecharoja.png' alt="" />
                <a href='/salketak'>Salketak</a>
            </div>
            </div>

            {gidarias.length > 0 ? (
                gidarias.map((gidaria) => (
                    <Gidaria key={gidaria.id} pilot={gidaria} />
                ))
            ) : (
                null
            )}
            {taldeak.length > 0 ? (
                taldeak.map((taldea) => (
                    <TaldeaSaldu key={taldea.id} pilot={taldea} />
                ))
            ) : (
                <h1>Ez duzu ofertarik</h1>
            )}
</div>
            <Footer />

        </>
    );
}

export default Ofertak;
