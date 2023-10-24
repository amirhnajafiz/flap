# Centralize logs in Kubernetes cluster

Centralized logging in K8s consists in having a daemon set for a logging agent,
that dispatches PODS logs in one or several stores.
The most famous solution is ELK (Elastic Search, Logstash and Kibana).
Logstash is considered to be greedy in resources, and many alternative exist (FileBeat, Fluentd, Fluent Bit…).
The daemon agent collects the logs and sends them to Elastic Search Data base . Dashboards are managed in Kibana.

Graylog is a leading centralized log management solution built to open standards for capturing, storing,
and enabling real-time analysis of terabytes of machine data.
We deliver a better user experience by making analytics ridiculously fast, efficient, affordable and flexible.
Graylag is a Java server that uses Elastic Search to store log entries.

Fluent Bit, which was developed by the same team than Fluentd,
but it is more performant and has a very low footprint. There are also less plug-ins than Fluentd, but those available are enough.
