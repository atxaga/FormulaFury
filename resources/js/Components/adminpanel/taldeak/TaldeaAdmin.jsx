import { usePage } from '@inertiajs/react';
import HeaderAdmin from './HeaderAdmin';
import Liga from './Taldea';
import '@/../css/adminpanel/ligak/nagusia.css';
import Footer from '@/Components/aktibitatea/Footer';
import Taldea from './Taldea';


function TaldeaAdmin(){
    const { taldeak = []} = usePage().props;
    return(
        <>  
        <div className='dena bg-black'>
            <HeaderAdmin />
            {taldeak.length > 0 ? 
                taldeak.map((taldea) =>(
                    <Taldea taldea={taldea} />
                )):(
                    <p>Ez daude ligarik</p>
                )   

            }
            </div>
        </>
    )
}
export default TaldeaAdmin;