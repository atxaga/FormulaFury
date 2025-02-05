import { usePage } from '@inertiajs/react';
import HeaderAdmin from './HeaderAdmin';
import Liga from './Bezeroa';
import '@/../css/adminpanel/ligak/nagusia.css';
import Footer from '@/Components/aktibitatea/Footer';
import Bezeroa from './Bezeroa';


function BezeroaAdmin(){
    const { bezeroak = []} = usePage().props;
    return(
        <>  
        <div className='dena bg-black'>
            <HeaderAdmin />
            {bezeroak.length > 0 ? 
                bezeroak.map((bezeroa) =>(
                    <Bezeroa bezeroa={bezeroa} />
                )):(
                    <p>Ez daude bezerorik</p>
                )   
            }
            </div>
        </>
    )
}
export default BezeroaAdmin;