import { usePage } from '@inertiajs/react';
import HeaderAdmin from './HeaderAdmin';
import Liga from './Liga';
import '@/../css/adminpanel/ligak/nagusia.css';
import Footer from '@/Components/aktibitatea/Footer';


function LigaAdmin(){
    const { ligak = []} = usePage().props;
    console.log(ligak);
    return(
        <>  
        <div className='dena bg-black'>
            <HeaderAdmin />
            {ligak.length > 0 ? 
                ligak.map((liga) =>(
                    <Liga liga={liga} />
                )):(
                    <p>Ez daude ligarik</p>
                )   

            }
            </div>
        </>
    )
}
export default LigaAdmin;