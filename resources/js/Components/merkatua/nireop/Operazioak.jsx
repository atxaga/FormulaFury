import Footer from '@/Components/basikoak/Footer';
import Gidaria from './Gidaria';
import Header from './Header';
import flechaurdin from '@/../images/flechurdin.png'
import { usePage } from '@inertiajs/react';
import '@/../css/nireop/nagusia.css';

function Operazioak(){
    const {pilot = []} = usePage().props;
    return(
        <>
        <Header/>
        <div className='pujakDiv'>
            <img src={flechaurdin} alt="" />
            <p>Erosketak</p>
        </div>
        {pilot.length > 0 ? (
            pilot.map((gidaria) => (
                <Gidaria pilot={gidaria} />
            ))
        ):(
            <h1>Ez duzu pujarik</h1>
        )}
        <Footer />
        </>
    );
}
export default Operazioak;