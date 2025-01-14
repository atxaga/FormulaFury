import kopiatu from '@/../images/kopiatu.png'
import '@/../css/klasifikazioOrria/kodea.css'

function Kodea({ligaId}) {
    const copiarAlPortapapeles = () => {
        const inputElement = document.getElementById('codigoInput');
        
        inputElement.select();
        inputElement.setSelectionRange(0, 99999); 

        navigator.clipboard.writeText(inputElement.value).then(() => {
            console.log("Código copiado al portapapeles!");
        }).catch((err) => {
            console.error("Error al copiar al portapapeles: ", err);
        });
    }

    return (
        <>
            <p className='titulo'>Zure lagunak gonbidatu</p>
            <p className="azpi text-sm">Zure lagunak gonbidatu sarbide kode baten bitartez</p>
            <div className='sarbideKodea'>
                <p>SARBIDE KODEA</p>
                <div className='kodea'>
                    <input 
                        type="text" 
                        className='input' 
                        value={ligaId.kodea} 
                        id="codigoInput" 
                        readOnly 
                    />
                    <img 
                        src={kopiatu} 
                        alt="Copiar código"
                        onClick={copiarAlPortapapeles} 
                    />
                </div>
            </div>
        </>
    )
}

export default Kodea;
