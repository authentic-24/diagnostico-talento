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
                'description' => 'La Resonancia del Sistema Límbico, son señales que el cerebro interpreta a nivel subconsciente, principalmente en el sistema límbico, la región asociada con las emociones, la motivación y la memoria. Cuando las acciones de la organización se alinean con sus valores declarados, se activa el sistema de recompensa del cerebro, liberando neurotransmisores como la dopamina. Esto genera un sentido de coherencia y confianza, reforzando la conexión emocional y la lealtad del colaborador.',
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
                'description' => 'La Narrativa del Cerebro Social. El cerebro humano, una máquina de contar historias, utiliza esta narrativa para dar sentido a la experiencia laboral. El propósito de la empresa, cuando es significativo, activa la corteza prefrontal medial, una región clave para el pensamiento social y la identificación.',
                'questions' => [
                    '¿Ha creado la compañía una "Estrella del Norte" o propósito claro que guíe todas sus acciones?',
                    '¿La "Estrella del Norte" se desarrolla y comunica activamente con todas las generaciones?',
                    '¿La empresa realiza esfuerzos continuos para sorprender y deleitar a sus colaboradores (ej. momentos WOW)?',
                    '¿Tu compañía deja huella en los pacientes/clientes/familiares y aliados?',
                    '¿Tu compañía busca dejar una huella positiva en la sociedad (ej. proyectos de impacto social, alianzas con startup de base Healtech, academia), buscando el mejoramiento continuo)?',
                    '¿Tu compañía desarrolla el "ADN" o característica distintiva que los hace únicos?',
                    '¿La cultura organizacional fomenta la innovación y la creatividad?',
                    '¿La empresa invierte en crear experiencias memorables para sus Colaboradores?'
                ]
            ],
            [
                'title' => 'Fomentar la Libertad y la Colaboración',
                'description' => 'El Circuito de la Creatividad el Vínculo Social y la autonomía, es una necesidad cerebral. La libertad de acción y la toma de decisiones activan los circuitos de recompensa y el lóbulo frontal, fomentando la proactividad y la creatividad. Por otro lado, la colaboración y el debate estimulan la empatía y la teoría de la mente (la capacidad de inferir los pensamientos y sentimientos de los demás), habilidades que residen en la corteza prefrontal y el surco temporal superior. Un ambiente que promueve la libertad y el intercambio de ideas no solo optimiza el desempeño, sino que también fortalece las redes neuronales sociales, esenciales para la cohesión y la resolución de problemas complejos.',
                'questions' => [
                    '¿La compañía fomenta la existencia de grupos interdisciplinarios para la conversación y el debate?',
                    '¿Estos grupos abordan temas como innovación de producto y bienestar emocional?',
                    '¿Existen grupos de escucha interdisciplinarios que incluyan a todas las generaciones de colaboradores?',
                    '¿Se promueven debates de conocimiento dentro de la organización?',
                    '¿Los colaboradores tienen autonomía para proponer y desarrollar nuevas ideas?',
                    '¿La empresa apoya la experimentación y el aprendizaje de los errores?',
                    '¿Se facilita la co-creación entre diferentes departamentos o áreas?',
                    '¿Se fomenta la diversidad de pensamiento y perspectivas?',
                    '¿Se utilizan herramientas y plataformas que faciliten la comunicación a fin de ser co-equiperos?',
                    '¿La organización es flexible en cuanto a horarios o modalidades de trabajo para fomentar la libertad? (Ej: Las madres lactantes trabajan 10 hrs menos a la semana. Ej: se realiza un día de Pet Friendly en la oficina).'
                ]
            ],
            [
                'title' => 'Gestión del Conocimiento',
                'description' => 'Plasticidad Neuronal y la Neurogénesis. El aprendizaje continuo es la clave de la plasticidad neuronal, la capacidad del cerebro para cambiar y adaptarse. La gestión del conocimiento, entendida como la promoción de nuevos aprendizajes y el desarrollo profesional, fomenta la formación de nuevas sinapsis y, en el hipocampo, la neurogénesis (la creación de nuevas neuronas). Proporcionar oportunidades de aprendizaje no solo aumenta las habilidades, sino que también mantiene al 🧠 cerebro ágil, activo y resiliente al estrés.',
                'questions' => [
                    '¿La compañía cuenta con programas de mentoría internas y/o externas?',
                    '¿La compañía cuenta con programas de coaching ontológico y ejecutivo?',
                    '¿Existen "canastas" de conocimiento en temas técnicos donde el colaborador puede escoger lo que desea aprender?',
                    '¿Se ofrecen "canastas" de competencias comportamentales para el desarrollo personal y profesional?',
                    '¿Se fomenta el intercambio de conocimientos entre colaboradores y externos (ej. comunidades de práctica, fundaciones, startup, academia, entre otros)?',
                    '¿Se invierte en plataformas o herramientas para la gestión y acceso al conocimiento (ej. E-learning para QP, IQ, IB Y QF de Authentic Farma, Platzi)?',
                    '¿Se promueve la participación en congresos, seminarios y/o cursos externos?',
                    '¿Logras el presupuesto dedicado a la formación y el desarrollo?',
                    '¿Se evalúa la efectividad de las iniciativas de gestión del conocimiento?',
                    '¿Los líderes actúan como facilitadores del aprendizaje en sus equipos?'
                ]
            ],
            [
                'title' => 'Plan de Desarrollo (Trainee y Movilidad Interna)',
                'description' => 'Motivación, Crecimiento y Sistema de Recompensa. Un plan de desarrollo bien estructurado refuerza el sistema de recompensa del cerebro. La percepción de crecimiento y oportunidades de movilidad interna activa la corteza prefrontal ventromedial, una región involucrada en la toma de decisiones basada en el valor. Este proceso libera dopamina, impulsando la motivación y el compromiso, lo que fortalece su autoeficacia y reduce la indefensión aprendida.',
                'questions' => [
                    '¿El plan de desarrollo lo decide principalmente el líder o hay participación activa del colaborador?',
                    '¿La empresa identifica y potencia al "top talent" (ej. el 10% de la compañía) a través de múltiples evaluaciones?',
                    '¿Se realizan intercambios o benchmarking con otras compañías para el desarrollo de los colaboradores?',
                    '¿Existen "planes de trainee" o rotaciones de roles (ej. comerciales en logística), logren desarrollar sus powers skill o competencias técnicas?',
                    '¿Fomenta movilidad horizontal, rotación de cargos, movilidad Interdepartamental, proyectos espaciales o asignaciones temporales y movilidad geográfica, y el crecimiento de carrera dentro de la organización?'
                ]
            ],
            [
                'title' => 'Tecnología',
                'description' => 'Interacción Cerebro-Herramienta. La tecnología no es neutral. Las herramientas digitales, cuando están bien integradas, actúan como extensiones de nuestras capacidades cognitivas. Una tecnología intuitiva y bien diseñada reduce la carga cognitiva (el esfuerzo mental necesario para realizar una tarea), liberando recursos cerebrales para tareas de mayor nivel, como la creatividad y la resolución de problemas. La integración de la tecnología debe ser guiada por la neuroergonomía para optimizar el rendimiento humano.',
                'questions' => [
                    '¿La organización integra eficazmente nuevas herramientas tecnológicas en los programas de desarrollo de liderazgo para preparar a los líderes ante un entorno de cambio constante?',
                    '¿Existen sistemas y procesos implementados que garanticen que la toma de decisiones sobre el talento se base en datos y analítica, complementados con un criterio humano?',
                    '¿Está nuestra área de RH en la vanguardia de la innovación, actuando como el motor que impulsa y lidera los proyectos tecnológicos más audaces de la compañía?',
                    '¿Existen iniciativas específicas de formación a los colaboradores en el uso de la IA y otras tecnologías emergentes, con el fin de optimizar sus funciones y potenciar su desarrollo?'
                ]
            ],
            [
                'title' => 'Auto liderazgo',
                'description' => 'Metacognición y Consciencia de Sí Mismo. El autoliderazgo es la capacidad de cada individuo para regular su propio cerebro y comportamiento. Fomentar el autoconocimiento y el empoderamiento individual activa la red de modo por defecto (relacionada con la reflexión personal y la introspección) y la corteza prefrontal dorsolateral (asociada con la autorregulación y el control ejecutivo).',
                'questions' => [
                    'La organización utiliza herramientas o metodologías para ayudar a los talentos a identificar su tipo de Diseño Humano (Manifestador: es quien inicia y abre caminos, movido por su impulso de acción, Generador: es quien responde y crea con energía constante, encontrando satisfacción al construir. Proyector : es quien guía y orienta, con capacidad de ver y dirigir la energía de otros. o Reflector : es quien refleja y amplifica su entorno, funcionando como un espejo social y emocional.) y esta comprensión impacta positivamente en su desarrollo profesional.',
                    '¿Se fomenta la autenticidad y el autoconocimiento en el rol profesional, basándose en los principios del Diseño Humano, para que los individuos puedan vivir con mayor facilidad y plenitud?',
                    '¿La organización promueve una perspectiva de descolonización en la cultura laboral para crear un ambiente más equitativo, libre de sesgos y con estructuras menos jerárquicas?',
                    '¿Se implementan estrategias para empoderar a los individuos a tomar decisiones desde su propio diseño y autoridad interna, fomentando un mayor auto liderazgo en su desempeño?'
                ]
            ],
            [
                'title' => 'Beneficios',
                'description' => 'Satisfacción de Necesidades Fundamentales del Cerebro. Los beneficios ofrecidos por la empresa activan el sistema de recompensa del cerebro al satisfacer necesidades fundamentales de seguridad y bienestar. La adaptabilidad de los beneficios (por ejemplo, opciones personalizables) se alinea con la diversidad de circuitos cerebrales y motivaciones individuales. Los beneficios que cubren aspectos como la salud, la alimentación y el descanso, actúan como señales de seguridad y cuidado, lo que reduce la percepción de amenaza y activa el sistema parasimpático, promoviendo la relajación y el bienestar general.',
                'questions' => [
                    '¿Los beneficios ofrecidos por la organización son altamente valorados por los colaboradores en la actualidad y se alinean con las necesidades de los diferentes segmentos de la fuerza laboral?',
                    '¿La organización evalúa regularmente la efectividad de los programas de beneficios existentes para asegurar que satisfagan las expectativas y promuevan el bienestar general de los colaboradores?',
                    'Existen mecanismos efectivos para comunicar el valor de los beneficios a los colaboradores y cómo estos contribuyen a su calidad de vida y desarrollo profesional.',
                    '¿La organización está explorando activamente nuevos modelos de beneficios que se adapten a las tendencias actuales del mercado laboral y a las necesidades cambiantes de los Colaboradores, como la flexibilidad y el bienestar integral?',
                    '¿Cómo estamos utilizando la tecnología para ofrecer a nuestros Colaboradores la posibilidad de diseñar su propio paquete de beneficios, asegurando que el apoyo que reciben sea tan único como sus propias vidas (como nuestro aliado: https://www.docokids.com , atención 24/7 resolviendo inquietudes pediátricas)'
                ]
            ],
            [
                'title' => 'Bienestar y Salud Mental',
                'description' => 'El Eje Cerebro-Cuerpo y la Neurobiología del Estrés. El bienestar y la salud mental son la base del funcionamiento óptimo del cerebro. La flexibilidad laboral reduce la activación del eje hipotalámico-pituitario-adrenal (HPA), el principal sistema de respuesta al estrés. Un sentido de propósito claro y una cultura que apoya la salud mental fomentan un ambiente seguro y estable, reduciendo la ansiedad y la depresión, y permitiendo que la corteza prefrontal, el centro de la toma de decisiones y la creatividad, funcione de manera óptima.',
                'questions' => [
                    '¿Están reimaginando la estructura del trabajo para ofrecer la flexibilidad y autonomía que sus equipos necesitan para alcanzar su máximo potencial y equilibrar sus vidas personales y profesionales?',
                    '¿Desarrollan iniciativas para conectar el bienestar con un sentido de propósito más grande, permitiendo que los colaboradores se sientan parte de un impacto positivo en la comunidad y en el mundo?',
                    '¿Están integrando la salud mental como un pilar fundamental en su cultura corporativa, más allá de la simple provisión de servicios, para normalizar las conversaciones y eliminar el estigma?',
                    '¿Qué herramientas y tecnologías digitales están ofreciendo a sus colaboradores (aplicaciones de salud mental, como nuestro aliado Empathica (Empathica.com.co/empresas ) y  gestionar su bienestar emocional de manera proactiva y personalizada?',
                    '¿Sus programas de bienestar fomentan el aprendizaje continuo y el desarrollo de habilidades, garantizando que los Colaboradores se sientan equilibrados, y estén preparados para prosperar en un futuro del trabajo en constante cambio?',
                    'Considerando que el trabajo requiere desafíos, multipropósitos y puede ser muy demandante. Utilizan prácticas o herramientas, son co- equiperos gestionando el estrés y evitando el agotamiento'
                ]
            ],
            [
                'title' => 'Salud Física y Flexibilidad',
                'description' => 'Conexión Cerebro-Cuerpo. La salud física está intrínsecamente ligada a la salud del cerebro. El ejercicio físico, por ejemplo, estimula la neurogénesis y aumenta el flujo sanguíneo cerebral, mejorando la función cognitiva. El apoyo de la organización a la salud física y a iniciativas de impacto social y ambiental, que activan los sistemas cerebrales de empatía y altruismo, fortalece la conexión mente-cuerpo y el bienestar holístico.',
                'questions' => [
                    '¿Están redefiniendo la salud física, que incluya apoyo a la nutrición, al sueño, a la ergonomía en el teletrabajo y a un estilo de vida activo y flexible?',
                    '¿Estamos explorando beneficios innovadores que se adapten a la vida moderna, como micro-subsidios para actividades al aire libre o suscripciones a servicios de bienestar integral, utilización de subsidios para evitar uso de carro, uso de monopatín, en lugar de paquetes únicos y rígidos?',
                    '¿Están cultivando una cultura con propósito donde cada Colaborador pueda contribuir a causas sociales y ambientales que les importan?',
                    '¿Están explorando herramientas tecnológicas o asociaciones con expertos para ofrecer educación financiera, salud financiera, asesoramiento sobre inversiones, ahorros o talleres sobre presupuesto de manera accesible para todos?',
                    'El área de RRHH está liderando el compromiso de la empresa con la comunidad, son parte de amplificar el impacto social y medio ambiente (ej:  ser sponsor de YoSoy Startup de Salud Femenina * Rompiendo Tabúes y transformando la Salud Femenina a fin de prevenir cáncer de útero y seno en Colombia) : https://yo-soy.co/'
                ]
            ],
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
