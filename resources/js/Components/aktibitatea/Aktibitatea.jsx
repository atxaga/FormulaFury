import Footer from './Footer';
import Header from './Header';
import flechaurdin from '@/../images/flechurdin.png';
import { usePage } from '@inertiajs/react';
import '@/../css/historikoa/historikoa.css';
import Mugimendua from './Mugimendua';

function Aktibitatea() {
    const {mugimenduak = []} = usePage().props;
    const { liga } = usePage().props;
    const { bezeroa } = usePage().props;
    console.log('Mugi'+mugimenduak);

    

    return (
        <>
            <Header liga={liga} bezeroa={bezeroa}/>
            

            {mugimenduak.length > 0 ? (
                mugimenduak.map((mugimendua) => (
                    <Mugimendua key={mugimendua.id} mugimendua={mugimendua} />
                ))
            ) : (
                <h1>Ez duzu mugimendurik</h1>
            )}

            <Footer />
        </>
    );
}

export default Aktibitatea;
