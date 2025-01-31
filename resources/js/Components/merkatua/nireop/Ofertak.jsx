import Footer from '../Footer';
import Gidaria from './Gidaria';
import Header from './Header';
import flechaurdin from '@/../images/flechurdin.png';

import { usePage } from '@inertiajs/react';
import '@/../css/nireop/nagusia.css';

function Ofertak() {
    const { gidarias = [] } = usePage().props;
    const { puja = [] } = usePage().props; 
    const { liga } = usePage().props;
    const { bezeroa } = usePage().props;


    return (
        <>  
            <div style={{marginBottom:'10%'}}>
            <Header liga={liga} bezeroa={bezeroa}/>
            <div className='menu' style={{display:'flex'}}>
            <a href="/nireoperazioak">
            <div className="pujakDiv">
                <img src={flechaurdin} alt="" />
                <p>Erosketak</p>
            </div>
            </a>
            <div className="pujakDiv">
                <img src='/images/flecharoja.png' alt="" />
                <p>Salketak</p>
            </div>
            </div>

            {gidarias.length > 0 ? (
                gidarias.map((gidaria) => (
                    <Gidaria key={gidaria.id} pilot={gidaria} />
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
