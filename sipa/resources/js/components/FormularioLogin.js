import React from 'react'

const FormularioLogin = () => (
    

        <form /* onSubmit={this.obtieneClaveUsuario} */ >
            <section id = 'usuario'>
                <label for ="usuario" className = "labelUsuarioLogin">Usuario</label>
                <input type = "text" placeholder="Ingrese su cédula" name="usuario" className="inputUsuarioLogin"/>
            </section>
            <section id = 'clave'>
                <label for ="contrasenia" className = "labelClaveLogin">Contraseña</label>
                <input type = "password" placeholder="Ingrese su contraseña" name="clave" className = "inputClaveLogin"/>
            </section>
            <button href="#" className ="acceder">Acceder</button>

            <section className='olvidaContrasenia'>
                <p><a href="https://www.claves.una.ac.cr/" id='olvideClave'> Olvidé mi contraseña </a></p>
            </section>
        </form>
)

export default FormularioLogin