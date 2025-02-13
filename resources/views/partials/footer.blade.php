<footer class="bg-dark text-light py-4 mt-auto" aria-label="Rodapé">
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <h2 class="h5">Navegação</h2>
                <ul class="list-unstyled">
                    <li><a href="{{ route('properties.index') }}" class="text-decoration-none text-light" aria-label="Lista de imóveis">Imóveis</a></li>
                    <li><a href="{{ route('about') }}" class="text-decoration-none text-light" aria-label="Sobre nós">Sobre</a></li>
                    <li><a href="{{ route('contact') }}" class="text-decoration-none text-light" aria-label="Contato">Contato</a></li>
                </ul>
            </div>
            
            <div class="col">
                <h2 class="h5">Legal</h2>
                <ul class="list-unstyled">
                    <li><a href="{{ route('privacy') }}" class="text-decoration-none text-light" aria-label="Política de privacidade">Privacidade</a></li>
                    <li><a href="{{ route('terms') }}" class="text-decoration-none text-light" aria-label="Termos de uso">Termos</a></li>
                </ul>
            </div>
            
            <div class="col">
                <h2 class="h5">Social</h2>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-decoration-none text-light" aria-label="Facebook"><span aria-hidden="true">📘</span> Facebook</a></li>
                    <li><a href="#" class="text-decoration-none text-light" aria-label="Instagram"><span aria-hidden="true">📸</span> Instagram</a></li>
                    <li><a href="#" class="text-decoration-none text-light" aria-label="LinkedIn"><span aria-hidden="true">💼</span> LinkedIn</a></li>
                </ul>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <p class="mb-0">&copy; {{ now()->year }} KUBICO. Todos os direitos reservados.</p>
            <a href="#top" class="text-decoration-none text-light mt-2 d-inline-block" 
               aria-label="Voltar ao topo da página" role="button">
                ↑ Voltar ao topo
            </a>
        </div>
    </div>
</footer>