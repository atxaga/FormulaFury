import Footer from '../Footer';
import Gidaria from './Mugimendua';
import Header from './Header';
import flechaurdin from '@/../images/flechurdin.png';
import { usePage } from '@inertiajs/react';
import '@/../css/historikoa/historikoa.css';
import Mugimendua from './Mugimendua';

function Historikoa() {
    const {mugimenduak = []} = usePage().props;
    const { liga } = usePage().props;
    const { bezeroa } = usePage().props;
    const { erabiltzailea } = usePage().props;
    

    return (
        <>
            <Header liga={liga} bezeroa={bezeroa} erabiltzailea={erabiltzailea}/>
            

            {mugimenduak.length > 0 ? (
                mugimenduak.map((mugimendua) => (
                    <Mugimendua key={mugimendua.id} mugimendua={mugimendua} />
                ))
            ) : (
                <h1 style={{textAlign:'center', marginTop: '4%'}}>Ez duzu mugimendurik</h1>
            )}

            <Footer />
        </>
    );
}

export default Historikoa;
