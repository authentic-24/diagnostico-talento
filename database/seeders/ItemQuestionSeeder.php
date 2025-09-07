<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Question;

class ItemQuestionSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'title' => 'Valores Organizacionales',
                'description' => 'Valores Organizacionales',
                'questions' => [
                    '¿La empresa realiza rituales o actividades específicas para reforzar sus valores?',
                    '¿Existen símbolos visuales o materiales que representen los valores de la organización?',
                    '¿Se llevan a cabo ceremonias o eventos para celebrar el cumplimiento o la vivencia de los valores?',
                    '¿Mantienen vivos y relevantes los valores en la cultura organizacional?',
                    '¿Crees que los valores de la empresa son un pilar en la toma de decisiones estratégicas?',
                    '¿Se promueve la difusión de historias de éxito que ejemplifican los valores?',
                    '¿Existe un reconocimiento por vivir los valores de la compañía?'
                ]
            ],
            [
                'title' => 'Principios de Experiencia del Colaborador (Employer Branding y Employee Journey)',
                'description' => 'Principios de Experiencia del Colaborador (Employer Branding y Employee Journey)',
                'questions' => [
                    '¿Ha creado la compañía una "Estrella del Norte" o propósito claro que guíe todas sus acciones?',
                    '¿La "Estrella del Norte" se desarrolla y comunica activamente con todas las generaciones de colaboradores?',
                    '¿La empresa realiza esfuerzos continuos para sorprender y deleitar a sus colaboradores (ej. momentos WOW)?',
                    '¿Tu compañía deja huella en sus pacientes/clientes y aliados?',
                    '¿Tu compañía busca dejar una huella positiva en la sociedad (ej. proyectos de impacto social, alinean con startup, buscan el mejoramiento continuo)?',
                    '¿Tu compañía desarrolla el "ADN" o característica distintiva que los hace únicos?',
                    '¿La cultura organizacional fomenta la innovación y la creatividad?',
                    '¿La empresa invierte en crear experiencias memorables para sus Colaboradores?'
                ]
            ],
            [
                'title' => 'Fomentar la Libertad y la Colaboración',
                'description' => 'Fomentar la Libertad y la Colaboración',
                'questions' => [
                    '¿La compañía fomenta la existencia de grupos interdisciplinarios para la conversación y el debate?',
                    '¿Estos grupos abordan temas como innovación de producto y bienestar emocional?',
                    '¿Existen grupos de escucha interdisciplinarios que incluyan a todas las generaciones de colaboradores?',
                    '¿Se promueven debates de conocimiento dentro de la organización?',
                    '¿Los colaboradores tienen autonomía para proponer y desarrollar nuevas ideas?',
                    '¿La empresa apoya la experimentación y el aprendizaje de los errores?',
                    '¿Se facilita la colaboración entre diferentes departamentos o áreas?',
                    '¿Se fomenta la diversidad de pensamiento y perspectivas?',
                    '¿Se utilizan herramientas y plataformas que faciliten la comunicación a fin de ser co-equiperos?',
                    '¿La organización es flexible en cuanto a horarios o modalidades de trabajo para fomentar la libertad?'
                ]
            ],
            [
                'title' => 'Gestión del Conocimiento (Aquello que yo quiero aprender)',
                'description' => 'Gestión del Conocimiento (Aquello que yo quiero aprender)',
                'questions' => [
                    '¿La compañía cuenta con programas de mentoría internos y/o externos?',
                    '¿La compañía cuenta con programas de coaching ontológico y ejecutivo?',
                    '¿Existen "canastas" de conocimiento en temas técnicos donde el colaborador puede escoger lo que desea aprender?',
                    '¿Se ofrecen "canastas" de competencias comportamentales para el desarrollo personal y profesional?',
                    '¿Se fomenta el intercambio de conocimientos entre colaboradores y externos (ej. comunidades de práctica, fundaciones, startup)?',
                    '¿Se invierte en plataformas o herramientas para la gestión y acceso al conocimiento?',
                    '¿Se promueve la participación en congresos, seminarios y/o cursos externos?',
                    '¿Logras el presupuesto dedicado a la formación y el desarrollo?',
                    '¿Se evalúa la efectividad de las iniciativas de gestión del conocimiento?',
                    '¿Los líderes actúan como facilitadores del aprendizaje en sus equipos?'
                ]
            ],
            [
                'title' => 'Plan de Desarrollo (Trading y Movilidad Interna)',
                'description' => 'Plan de Desarrollo (Trading y Movilidad Interna)',
                'questions' => [
                    '¿El plan de desarrollo lo decide principalmente el líder o hay participación activa del colaborador?',
                    '¿La empresa identifica y potencia al "top talent" (ej. el 10% de la compañía) a través de múltiples evaluaciones?',
                    '¿Se realizan intercambios o benchmarking con otras compañías para el desarrollo de los colaboradores?',
                    '¿Existen "planes de trading" o rotaciones de roles (ej. comerciales trabajando en logística) y que logren desarrollar powers skill o competencias técnicas?',
                    '¿Fomenta la movilidad interna y el crecimiento de carrera dentro de la organización?'
                ]
            ],
            [
                'title' => 'Tecnología',
                'description' => 'Tecnología',
                'questions' => [
                    '¿La organización integra eficazmente nuevas herramientas tecnológicas en los programas de desarrollo de liderazgo para preparar a los líderes ante un entorno de cambio constante?',
                    '¿Existen sistemas y procesos implementados que garanticen que la toma de decisiones sobre el talento se base en datos y analítica, complementados con un criterio humano?',
                    '¿Está nuestra área de RH en la vanguardia de la innovación, actuando como el motor que impulsa y lidera los proyectos tecnológicos más audaces de la compañía?',
                    '¿Existen iniciativas específicas para capacitar a los colaboradores en el uso de la IA y otras tecnologías emergentes, con el fin de optimizar sus funciones y potenciar su desarrollo?'
                ]
            ],
            [
                'title' => 'Auto liderazgo',
                'description' => 'Auto liderazgo',
                'questions' => [
                    '¿La organización utiliza herramientas o metodologías para ayudar a los talentos a identificar su tipo de Diseño Humano (Manifestador, Generador, Proyector o Reflector) y esta comprensión impacta positivamente en su desarrollo profesional?',
                    '¿Se fomenta la autenticidad y el autoconocimiento en el rol profesional, basándose en los principios del Diseño Humano, para que los individuos puedan vivir con mayor facilidad y plenitud?',
                    '¿La organización promueve una perspectiva de descolonización en la cultura laboral para crear un ambiente más equitativo, libre de sesgos y con estructuras menos jerárquicas?',
                    '¿Se implementan estrategias para empoderar a los individuos a tomar decisiones desde su propio diseño y autoridad interna, fomentando un mayor auto liderazgo en su desempeño?'
                ]
            ],
            [
                'title' => 'Beneficios',
                'description' => 'Beneficios',
                'questions' => [
                    '¿Los beneficios ofrecidos por la organización son altamente valorados por los colaboradores en la actualidad y se alinean con las necesidades de los diferentes segmentos de la fuerza laboral?',
                    '¿La organización evalúa regularmente la efectividad de los programas de beneficios existentes para asegurar que satisfagan las expectativas y promuevan el bienestar general de los colaboradores?',
                    '¿Existen mecanismos efectivos para comunicar el valor de los beneficios a los empleados y cómo estos contribuyen a su calidad de vida y desarrollo profesional?',
                    '¿La organización está explorando activamente nuevos modelos de beneficios que se adapten a las tendencias actuales del mercado laboral y a las necesidades cambiantes de los Colaboradores, como la flexibilidad y el bienestar integral?',
                    '¿Cómo estamos utilizando la tecnología para ofrecer a nuestros Colaboradores la posibilidad de diseñar su propio paquete de beneficios, asegurando que el apoyo que reciben sea tan único como sus propias vidas?'
                ]
            ],
            [
                'title' => 'Bienestar y Salud Mental',
                'description' => 'Bienestar y Salud Mental',
                'questions' => [
                    '¿Están reimaginando la estructura del trabajo para ofrecer la flexibilidad y autonomía que sus equipos necesitan para alcanzar su máximo potencial y equilibrar sus vidas personales y profesionales?',
                    '¿Desarrollan iniciativas para conectar el bienestar con un sentido de propósito más grande, permitiendo que los colaboradores se sientan parte de un impacto positivo en la comunidad y en el mundo?',
                    '¿Están integrando la salud mental como un pilar fundamental en su cultura corporativa, más allá de la simple provisión de servicios, para normalizar las conversaciones y eliminar el estigma?',
                    '¿Qué herramientas y tecnologías digitales están ofreciendo a sus colaboradores (como aplicaciones de salud mental como Empathica) y gestionar su bienestar emocional de manera proactiva y personalizada?',
                    '¿Sus programas de bienestar fomentan el aprendizaje continuo y el desarrollo de habilidades, garantizando que los Colaboradores se sientan equilibrados, y estén preparados para prosperar en un futuro del trabajo en constante cambio?',
                    '¿Considerando que el trabajo requiere desafíos, multipropósitos y puede ser muy demandante, utilizan prácticas o herramientas, como equipo gestionan el estrés y evitan el agotamiento?'
                ]
            ],
            [
                'title' => 'Salud Física y Flexibilidad',
                'description' => 'Salud Física y Flexibilidad',
                'questions' => [
                    '¿Están redefiniendo la salud física, que incluya apoyo a la nutrición, al sueño, a la ergonomía en el teletrabajo y a un estilo de vida activo y flexible?',
                    '¿Estamos explorando beneficios innovadores que se adapten a la vida moderna, como micro-subsidios para actividades al aire libre o suscripciones a servicios de bienestar integral, en lugar de paquetes únicos y rígidos?',
                    '¿Están cultivando una cultura con propósito donde cada Colaborador pueda contribuir a causas sociales y ambientales que les importan?',
                    '¿Están explorando herramientas tecnológicas o asociaciones con expertos para ofrecer educación financiera, salud financiera, asesoramiento sobre inversiones, ahorros o talleres sobre presupuesto de manera accesible para todos?',
                    '¿El área de RRHH está liderando el compromiso de la empresa con la comunidad, impacto social, medio ambiente, y cómo son parte de amplificar el impacto, por ejemplo ser sponsor de YoSoy Startup de Salud Femenina para prevenir cáncer de útero y seno en Colombia?'
                ]
            ]
        ];

        foreach ($items as $iIndex => $i) {
            $item = Item::create([
                'title' => $i['title'],
                'description' => $i['description'],
                'order' => $iIndex + 1
            ]);

            foreach ($i['questions'] as $qIndex => $q) {
                Question::create([
                    'item_id' => $item->id,
                    'text' => $q,
                    'type' => 'radio',
                    'options' => 'Constantemente,Frecuentemente,Ocasionalmente,Casi nunca',
                    'order' => $qIndex + 1,
                    'required' => true
                ]);
            }
        }
    }
}
